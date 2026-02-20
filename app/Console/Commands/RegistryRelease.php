<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class RegistryRelease extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:release {component : The component name} {version : The version to release}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release a new version of a component';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $componentName = $this->argument('component');
        $version = $this->argument('version');

        if (! $this->isValidComponentName($componentName)) {
            $this->error("Invalid component name: {$componentName}");

            return 1;
        }

        if (! $this->isValidVersion($version)) {
            $this->error("Invalid version format: {$version}. Use semantic versioning (e.g., 1.0.0)");

            return 1;
        }

        $componentPath = base_path("registry/components/{$componentName}");

        if (! is_dir($componentPath)) {
            $this->error("Component '{$componentName}' not found at {$componentPath}");

            return 1;
        }

        // Check if version already exists
        $versionPath = "{$componentPath}/{$version}";
        if (is_dir($versionPath)) {
            $this->error("Version {$version} already exists for component {$componentName}");

            return 1;
        }

        try {
            // Get latest version info
            $versionsData = $this->getVersionsData($componentName);
            $latestVersion = $versionsData['latest'] ?? null;

            if (! $latestVersion) {
                $this->error("Could not determine latest version for component {$componentName}");

                return 1;
            }

            // Validate version progression
            if (! $this->isVersionProgressionValid($latestVersion, $version)) {
                $this->error("Version {$version} is not greater than latest version {$latestVersion}");

                return 1;
            }

            $sourcePath = "{$componentPath}/{$latestVersion}";

            if (! is_dir($sourcePath)) {
                $this->error("Latest version directory {$latestVersion} not found");

                return 1;
            }

            // Create new version directory
            if (! mkdir($versionPath, 0755, true)) {
                $this->error("Failed to create version directory: {$versionPath}");

                return 1;
            }

            // Copy files from latest version
            $this->info("Copying files from v{$latestVersion} to v{$version}...");
            $this->copyDirectory($sourcePath, $versionPath);

            // Update versions.json
            $this->info('Updating versions.json...');
            $this->updateVersionsJson($componentName, $version);

            $this->info("✅ Component '{$componentName}' version {$version} released successfully!");
            $this->info("Previous latest: {$latestVersion} → New latest: {$version}");

        } catch (\Exception $e) {
            $this->error('Release failed: '.$e->getMessage());

            return 1;
        }

        return 0;
    }

    /**
     * Validate component name format
     */
    private function isValidComponentName(string $name): bool
    {
        return preg_match('/^[a-z][a-z0-9-_]*$/', $name) === 1;
    }

    /**
     * Validate semantic version format
     */
    private function isValidVersion(string $version): bool
    {
        return preg_match('/^\d+\.\d+\.\d+$/', $version) === 1;
    }

    /**
     * Check if version progression is valid
     */
    private function isVersionProgressionValid(string $current, string $next): bool
    {
        $currentParts = array_map('intval', explode('.', $current));
        $nextParts = array_map('intval', explode('.', $next));

        // Compare major, minor, patch versions
        for ($i = 0; $i < 3; $i++) {
            if ($nextParts[$i] > $currentParts[$i]) {
                return true;
            } elseif ($nextParts[$i] < $currentParts[$i]) {
                return false;
            }
        }

        return false; // Versions are equal
    }

    /**
     * Get versions data for a component
     */
    private function getVersionsData(string $componentName): ?array
    {
        $versionsFile = base_path("registry/components/{$componentName}/versions.json");

        if (! file_exists($versionsFile)) {
            return null;
        }

        $content = file_get_contents($versionsFile);
        $data = json_decode($content, true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $data;
    }

    /**
     * Update versions.json file
     */
    private function updateVersionsJson(string $componentName, string $newVersion): void
    {
        $versionsFile = base_path("registry/components/{$componentName}/versions.json");
        $versionsData = $this->getVersionsData($componentName);

        if (! $versionsData) {
            $versionsData = [
                'latest' => $newVersion,
                'versions' => [$newVersion],
            ];
        } else {
            // Add new version if not already present
            if (! in_array($newVersion, $versionsData['versions'])) {
                $versionsData['versions'][] = $newVersion;
            }

            // Update latest
            $versionsData['latest'] = $newVersion;

            // Sort versions
            usort($versionsData['versions'], function ($a, $b) {
                return version_compare($b, $a);
            });
        }

        file_put_contents($versionsFile, json_encode($versionsData, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
    }

    /**
     * Copy directory recursively
     */
    private function copyDirectory(string $source, string $destination): void
    {
        if (! is_dir($destination)) {
            mkdir($destination, 0755, true);
        }

        $files = scandir($source);
        foreach ($files as $file) {
            if ($file === '.' || $file === '..') {
                continue;
            }

            $sourceFile = "{$source}/{$file}";
            $destFile = "{$destination}/{$file}";

            if (is_dir($sourceFile)) {
                $this->copyDirectory($sourceFile, $destFile);
            } else {
                copy($sourceFile, $destFile);
            }
        }
    }
}
