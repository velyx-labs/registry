<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistryBump extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:bump {component : The component name} {type : Version bump type (patch|minor|major)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Automatically bump component version';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $componentName = $this->argument('component');
        $type = strtolower($this->argument('type'));

        if (! $this->isValidComponentName($componentName)) {
            $this->error("Invalid component name: {$componentName}");

            return 1;
        }

        if (! in_array($type, ['patch', 'minor', 'major'])) {
            $this->error("Invalid bump type: {$type}. Must be patch, minor, or major");

            return 1;
        }

        $componentPath = base_path("registry/components/{$componentName}");

        if (! is_dir($componentPath)) {
            $this->error("Component '{$componentName}' not found");

            return 1;
        }

        try {
            $versionsData = $this->getVersionsData($componentName);
            if (! $versionsData) {
                $this->error("Could not read versions data for component {$componentName}");

                return 1;
            }

            $currentVersion = $versionsData['latest'];
            $nextVersion = $this->calculateNextVersion($currentVersion, $type);

            // Check if version already exists
            if (in_array($nextVersion, $versionsData['versions'])) {
                $this->error("Version {$nextVersion} already exists for component {$componentName}");

                return 1;
            }

            $this->info("Bumping {$componentName}: {$currentVersion} → {$nextVersion} ({$type})");

            // Create new version by calling RegistryRelease
            $exitCode = $this->call('registry:release', [
                'component' => $componentName,
                'version' => $nextVersion,
            ]);

            if ($exitCode === 0) {
                $this->info('✅ Version bump completed successfully!');
            }

            return $exitCode;

        } catch (\Exception $e) {
            $this->error('Version bump failed: '.$e->getMessage());

            return 1;
        }
    }

    /**
     * Validate component name format
     */
    private function isValidComponentName(string $name): bool
    {
        return preg_match('/^[a-z][a-z0-9-_]*$/', $name) === 1;
    }

    /**
     * Calculate next version based on bump type
     */
    private function calculateNextVersion(string $current, string $type): string
    {
        $parts = array_map('intval', explode('.', $current));

        switch ($type) {
            case 'patch':
                $parts[2]++;
                break;
            case 'minor':
                $parts[1]++;
                $parts[2] = 0;
                break;
            case 'major':
                $parts[0]++;
                $parts[1] = 0;
                $parts[2] = 0;
                break;
        }

        return implode('.', $parts);
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
}
