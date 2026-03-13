<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistryValidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:validate {--component= : Validate specific component only}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Validate registry structure and component integrity';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $specificComponent = $this->option('component');
        $componentsPath = base_path('registry/components');

        if (! is_dir($componentsPath)) {
            $this->error('Registry directory not found');

            return 1;
        }

        $errors = [];
        $warnings = [];
        $validatedCount = 0;
        $composerRequirements = $this->loadComposerRequirements();
        $npmRequirements = $this->loadNpmRequirements();

        $components = glob($componentsPath.'/*', GLOB_ONLYDIR);

        if ($specificComponent) {
            $componentPath = $componentsPath.'/'.$specificComponent;
            if (! is_dir($componentPath)) {
                $this->error("Component '{$specificComponent}' not found");

                return 1;
            }
            $components = [$componentPath];
        }

        $this->info('🔍 Validating registry structure...');

        foreach ($components as $componentPath) {
            $componentName = basename($componentPath);

            if ($specificComponent && $componentName !== $specificComponent) {
                continue;
            }

            $this->line("  Validating component: {$componentName}");
            $validatedCount++;

            $componentErrors = $this->validateComponent(
                $componentName,
                $componentPath,
                $composerRequirements,
                $npmRequirements,
            );

            if (! empty($componentErrors['errors'])) {
                $errors = array_merge($errors, $componentErrors['errors']);
            }

            if (! empty($componentErrors['warnings'])) {
                $warnings = array_merge($warnings, $componentErrors['warnings']);
            }
        }

        $this->newLine();
        $this->info('📊 Validation Results:');
        $this->info("  Components validated: {$validatedCount}");

        if (empty($errors) && empty($warnings)) {
            $this->info('  ✅ All components passed validation!');

            return 0;
        }

        if (! empty($errors)) {
            $this->newLine();
            $this->error('  🔴 ERRORS ('.count($errors).'):');
            foreach ($errors as $error) {
                $this->line("    - {$error}");
            }
        }

        if (! empty($warnings)) {
            $this->newLine();
            $this->warn('  🟡 WARNINGS ('.count($warnings).'):');
            foreach ($warnings as $warning) {
                $this->line("    - {$warning}");
            }
        }

        $this->newLine();
        $this->info('🏁 Validation complete!');

        return empty($errors) ? 0 : 1;
    }

    /**
     * @param  array<string, string>  $composerRequirements
     * @param  array<string, string>  $npmRequirements
     */
    private function validateComponent(
        string $name,
        string $componentPath,
        array $composerRequirements,
        array $npmRequirements,
    ): array {
        $errors = [];
        $warnings = [];

        $metaFile = $componentPath.'/meta.json';
        if (! file_exists($metaFile)) {
            $errors[] = "{$name}: Missing meta.json";

            return ['errors' => $errors, 'warnings' => $warnings];
        }

        $meta = json_decode(file_get_contents($metaFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errors[] = "{$name}: Invalid JSON in meta.json";

            return ['errors' => $errors, 'warnings' => $warnings];
        }

        $requiredFields = ['name', 'version', 'description', 'laravel', 'requires_alpine', 'requires'];
        foreach ($requiredFields as $field) {
            if (! isset($meta[$field])) {
                $errors[] = "{$name}: Missing required field '{$field}' in meta.json";
            }
        }

        if (isset($meta['requires']) && is_array($meta['requires'])) {
            if (array_is_list($meta['requires'])) {
                $warnings[] = "{$name}: 'requires' should use object format with 'composer' and 'npm' arrays";
            } else {
                if (! array_key_exists('composer', $meta['requires']) || ! is_array($meta['requires']['composer'])) {
                    $errors[] = "{$name}: 'requires.composer' must be an array in meta.json";
                }

                if (! array_key_exists('npm', $meta['requires']) || ! is_array($meta['requires']['npm'])) {
                    $errors[] = "{$name}: 'requires.npm' must be an array in meta.json";
                }
            }
        }

        if (! empty($meta['requires']['composer']) && is_array($meta['requires']['composer'])) {
            $this->validateComposerDependencies($name, $meta['requires']['composer'], $composerRequirements, $errors);
        }

        if (! empty($meta['requires']['npm']) && is_array($meta['requires']['npm'])) {
            $this->validateNpmDependencies($name, $meta['requires']['npm'], $npmRequirements, $errors);
        }

        if (($meta['requires_alpine'] ?? false) && ! $this->hasVersionedDependency($meta['requires']['npm'] ?? [], 'alpinejs')) {
            $errors[] = "{$name}: 'requires_alpine' is true, but 'requires.npm' does not declare alpinejs with a version";
        }

        $versionsFile = $componentPath.'/versions.json';
        if (! file_exists($versionsFile)) {
            $errors[] = "{$name}: Missing versions.json";

            return ['errors' => $errors, 'warnings' => $warnings];
        }

        $versions = json_decode(file_get_contents($versionsFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            $errors[] = "{$name}: Invalid JSON in versions.json";

            return ['errors' => $errors, 'warnings' => $warnings];
        }

        if (! isset($versions['latest'])) {
            $errors[] = "{$name}: Missing 'latest' field in versions.json";
        }

        if (! isset($versions['versions']) || ! is_array($versions['versions'])) {
            $errors[] = "{$name}: Missing or invalid 'versions' array in versions.json";
        }

        $latestVersion = $versions['latest'] ?? null;
        $allVersions = $versions['versions'] ?? [];

        if ($latestVersion && ! in_array($latestVersion, $allVersions)) {
            $errors[] = "{$name}: Latest version '{$latestVersion}' not listed in versions array";
        }

        if ($latestVersion) {
            $versionPath = $componentPath.'/'.$latestVersion;
            if (! is_dir($versionPath)) {
                $errors[] = "{$name}: Latest version directory '{$latestVersion}' does not exist";
            } else {
                $declaredFiles = $meta['files'] ?? [];

                if (! is_array($declaredFiles) || empty($declaredFiles)) {
                    $warnings[] = "{$name}: No files declared in meta.json";
                } else {
                    $hasBladeFile = false;

                    foreach ($declaredFiles as $file) {
                        if (! is_array($file)) {
                            continue;
                        }

                        $relativePath = ltrim((string) ($file['path'] ?? ''), '/');
                        $fileType = (string) ($file['type'] ?? '');

                        if ($relativePath === '') {
                            $errors[] = "{$name}: One file entry in meta.json is missing a path";

                            continue;
                        }

                        if ($fileType === 'blade') {
                            $hasBladeFile = true;
                        }

                        $expectedFile = $versionPath.'/'.$relativePath;
                        if (! file_exists($expectedFile)) {
                            $errors[] = "{$name}: Missing declared file '{$relativePath}' in version {$latestVersion}";
                        }
                    }

                    if (! $hasBladeFile) {
                        $warnings[] = "{$name}: No Blade file declared in meta.json";
                    }
                }
            }
        }

        foreach ($allVersions as $version) {
            if (! preg_match('/^\d+\.\d+\.\d+$/', $version)) {
                $errors[] = "{$name}: Invalid version format '{$version}' (use semantic versioning)";
            }
        }

        return ['errors' => $errors, 'warnings' => $warnings];
    }

    /**
     * @param  array<int, string>  $dependencies
     * @param  array<string, string>  $requirements
     * @param  array<int, string>  $errors
     */
    private function validateComposerDependencies(string $name, array $dependencies, array $requirements, array &$errors): void
    {
        foreach ($dependencies as $dependency) {
            [$package, $version] = $this->parseComposerDependency($dependency);

            if ($package === null || $version === null) {
                $errors[] = "{$name}: Composer dependency '{$dependency}' must include a version using vendor/package@constraint or vendor/package:constraint";

                continue;
            }

            if (! array_key_exists($package, $requirements)) {
                $errors[] = "{$name}: Composer dependency '{$package}' is not declared in registry composer.json";

                continue;
            }

            if ($requirements[$package] !== $version) {
                $errors[] = "{$name}: Composer dependency '{$package}' must use version '{$requirements[$package]}' in meta.json";
            }
        }
    }

    /**
     * @param  array<int, string>  $dependencies
     * @param  array<string, string>  $requirements
     * @param  array<int, string>  $errors
     */
    private function validateNpmDependencies(string $name, array $dependencies, array $requirements, array &$errors): void
    {
        foreach ($dependencies as $dependency) {
            [$package, $version] = $this->parseNpmDependency($dependency);

            if ($package === null || $version === null) {
                $errors[] = "{$name}: npm dependency '{$dependency}' must include a version using package@constraint";

                continue;
            }

            if (! array_key_exists($package, $requirements)) {
                $errors[] = "{$name}: npm dependency '{$package}' is not declared in registry package.json";

                continue;
            }

            if ($requirements[$package] !== $version) {
                $errors[] = "{$name}: npm dependency '{$package}' must use version '{$requirements[$package]}' in meta.json";
            }
        }
    }

    /**
     * @param  array<int, string>  $dependencies
     */
    private function hasVersionedDependency(array $dependencies, string $package): bool
    {
        foreach ($dependencies as $dependency) {
            [$candidate, $version] = $this->parseNpmDependency($dependency);
            if ($candidate === $package && $version !== null) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    private function parseComposerDependency(string $dependency): array
    {
        if (str_contains($dependency, ':')) {
            [$package, $version] = explode(':', $dependency, 2);

            return [$package !== '' ? $package : null, $version !== '' ? $version : null];
        }

        if (str_contains($dependency, '@')) {
            $parts = explode('@', $dependency, 2);

            return [$parts[0] !== '' ? $parts[0] : null, $parts[1] !== '' ? $parts[1] : null];
        }

        return [null, null];
    }

    /**
     * @return array{0: string|null, 1: string|null}
     */
    private function parseNpmDependency(string $dependency): array
    {
        if (str_starts_with($dependency, '@')) {
            $separator = strrpos($dependency, '@');
            $slash = strpos($dependency, '/');

            if ($separator !== false && $slash !== false && $separator > $slash) {
                $package = substr($dependency, 0, $separator);
                $version = substr($dependency, $separator + 1);

                return [$package !== '' ? $package : null, $version !== '' ? $version : null];
            }

            return [null, null];
        }

        if (str_contains($dependency, '@')) {
            [$package, $version] = explode('@', $dependency, 2);

            return [$package !== '' ? $package : null, $version !== '' ? $version : null];
        }

        return [null, null];
    }

    /**
     * @return array<string, string>
     */
    private function loadComposerRequirements(): array
    {
        $composerFile = base_path('composer.json');

        if (! file_exists($composerFile)) {
            return [];
        }

        $composer = json_decode(file_get_contents($composerFile), true);
        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($composer)) {
            return [];
        }

        return array_merge($composer['require'] ?? [], $composer['require-dev'] ?? []);
    }

    /**
     * @return array<string, string>
     */
    private function loadNpmRequirements(): array
    {
        $packageFile = base_path('package.json');

        if (! file_exists($packageFile)) {
            return [];
        }

        $package = json_decode(file_get_contents($packageFile), true);
        if (json_last_error() !== JSON_ERROR_NONE || ! is_array($package)) {
            return [];
        }

        return array_merge($package['dependencies'] ?? [], $package['devDependencies'] ?? []);
    }
}
