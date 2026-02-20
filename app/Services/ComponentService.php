<?php

namespace App\Services;

class ComponentService
{
    protected string $componentsPath;

    public function __construct()
    {
        $this->componentsPath = base_path('registry/components');
    }

    /**
     * Get all available components
     */
    public function getAllComponents(): array
    {
        $components = [];

        if (! is_dir($this->componentsPath)) {
            return $components;
        }

        $componentDirs = glob($this->componentsPath.'/*', GLOB_ONLYDIR);

        foreach ($componentDirs as $dir) {
            $componentName = basename($dir);
            $componentData = $this->getComponentData($componentName);

            if ($componentData) {
                $components[$componentName] = $componentData;
            }
        }

        return $components;
    }

    /**
     * Get specific component data
     */
    public function getComponent(string $name, ?string $version = null): ?array
    {
        $componentPath = $this->componentsPath.'/'.$name;

        if (! is_dir($componentPath)) {
            return null;
        }

        // Get version data
        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            return null;
        }

        $targetVersion = $version ?? $versionsData['latest'];

        // Validate version exists
        if (! in_array($targetVersion, $versionsData['versions'])) {
            return null;
        }

        return $this->getComponentData($name, $targetVersion);
    }

    /**
     * Get versions data for a component
     */
    protected function getVersionsData(string $name): ?array
    {
        $versionsFile = $this->componentsPath.'/'.$name.'/versions.json';

        if (! file_exists($versionsFile)) {
            return null;
        }

        $versions = json_decode(file_get_contents($versionsFile), true);

        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return $versions;
    }

    /**
     * Get component data including files
     */
    protected function getComponentData(string $name, ?string $version = null): ?array
    {
        $componentPath = $this->componentsPath.'/'.$name;

        // Get meta data
        $metaFile = $componentPath.'/meta.json';
        if (! file_exists($metaFile)) {
            return null;
        }

        $meta = json_decode(file_get_contents($metaFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        // Get version data
        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            return null;
        }

        $targetVersion = $version ?? $versionsData['latest'];

        // Get files for the specified version
        $versionPath = $componentPath.'/'.$targetVersion;
        if (! is_dir($versionPath)) {
            return null;
        }

        $files = $this->getComponentFiles($name, $versionPath);

        return [
            'name' => $name,
            'version' => $targetVersion,
            'latest' => $versionsData['latest'],
            'versions' => $versionsData['versions'],
            'files' => $files,
            'meta' => [
                'requires' => $meta['requires'] ?? [],
                'requires_alpine' => $meta['requires_alpine'] ?? false,
                'description' => $meta['description'] ?? '',
                'laravel' => $meta['laravel'] ?? '>=10',
                'categories' => $meta['categories'] ?? [],
                'files' => $meta['files'] ?? [],
            ],
        ];
    }

    /**
     * Get component files mapped to user project structure
     */
    protected function getComponentFiles(string $name, string $versionPath): array
    {
        $files = [];
        $filesInDir = glob($versionPath.'/*');

        foreach ($filesInDir as $filePath) {
            $filename = basename($filePath);

            if (str_ends_with($filename, '.blade.php')) {
                $files['resources/views/components/ui/'.$name.'.blade.php'] = file_get_contents($filePath);
            } elseif (str_ends_with($filename, '.js')) {
                $files['resources/js/ui/'.$name.'.js'] = file_get_contents($filePath);
            } elseif (str_ends_with($filename, '.css')) {
                $files['resources/css/ui/'.$name.'.css'] = file_get_contents($filePath);
            }
        }

        return $files;
    }

    /**
     * Validate component name format
     */
    public function isValidComponentName(string $name): bool
    {
        return preg_match('/^[a-z][a-z0-9-_]*$/', $name) === 1;
    }

    /**
     * Validate semantic version
     */
    public function isValidVersion(string $version): bool
    {
        return preg_match('/^\d+\.\d+\.\d+$/', $version) === 1;
    }

    /**
     * Check if component exists
     */
    public function componentExists(string $name): bool
    {
        return is_dir($this->componentsPath.'/'.$name);
    }

    /**
     * Check if component version exists
     */
    public function versionExists(string $name, string $version): bool
    {
        if (! $this->componentExists($name)) {
            return false;
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            return false;
        }

        return in_array($version, $versionsData['versions']);
    }
}
