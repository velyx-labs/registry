<?php

namespace App\Services;

use App\Exceptions\ComponentNotFoundException;

class ComponentService
{
    protected string $componentsPath;

    public function __construct()
    {
        $this->componentsPath = base_path('registry/components');
    }

    /**
     * Get all available components (metadata only - no file contents loaded)
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
            $componentData = $this->getComponentMetadata($componentName);

            if ($componentData) {
                $components[$componentName] = $componentData;
            }
        }

        return $components;
    }

    /**
     * Get specific component metadata (without file contents)
     */
    public function getComponent(string $name, ?string $version = null): array
    {
        $componentPath = $this->componentsPath.'/'.$name;

        if (! is_dir($componentPath)) {
            throw new ComponentNotFoundException("Component '{$name}' does not exist");
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            throw new ComponentNotFoundException("Component '{$name}' versions data not found");
        }

        $targetVersion = $version ?? $versionsData['latest'];

        if (! in_array($targetVersion, $versionsData['versions'])) {
            throw new ComponentNotFoundException(
                "Component '{$name}' version '{$targetVersion}' does not exist"
            );
        }

        return $this->getComponentMetadata($name, $targetVersion);
    }

    /**
     * Get component with file contents (for download endpoint)
     *
     * @throws ComponentNotFoundException
     */
    public function getComponentWithFiles(string $name, ?string $version = null): array
    {
        $componentPath = $this->componentsPath.'/'.$name;

        if (! is_dir($componentPath)) {
            throw new ComponentNotFoundException("Component '{$name}' does not exist");
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            throw new ComponentNotFoundException("Component '{$name}' versions data not found");
        }

        $targetVersion = $version ?? $versionsData['latest'];

        if (! in_array($targetVersion, $versionsData['versions'])) {
            throw new ComponentNotFoundException(
                "Component '{$name}' version '{$targetVersion}' does not exist"
            );
        }

        return $this->getComponentDataWithFiles($name, $targetVersion);
    }

    /**
     * Get versions data for a component
     *
     * @throws ComponentNotFoundException
     */
    public function getVersions(string $name): array
    {
        if (! $this->componentExists($name)) {
            throw new ComponentNotFoundException("Component '{$name}' does not exist");
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            throw new ComponentNotFoundException("Component '{$name}' versions data not found");
        }

        return [
            'name' => $name,
            'latest' => $versionsData['latest'],
            'versions' => $versionsData['versions'],
        ];
    }

    /**
     * Get versions data from versions.json file
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
     * Get component metadata only (no file contents loaded)
     */
    protected function getComponentMetadata(string $name, ?string $version = null): ?array
    {
        $componentPath = $this->componentsPath.'/'.$name;

        $metaFile = $componentPath.'/meta.json';
        if (! file_exists($metaFile)) {
            return null;
        }

        $meta = json_decode(file_get_contents($metaFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            return null;
        }

        $targetVersion = $version ?? $versionsData['latest'];

        return [
            'name' => $name,
            'version' => $targetVersion,
            'latest' => $versionsData['latest'],
            'versions' => $versionsData['versions'],
            'files' => [],
            'meta' => [
                'requires' => $this->normalizeRequires($meta['requires'] ?? []),
                'requires_alpine' => $meta['requires_alpine'] ?? false,
                'description' => $meta['description'] ?? '',
                'laravel' => $meta['laravel'] ?? '>=10',
                'categories' => $meta['categories'] ?? [],
                'files' => $meta['files'] ?? [],
            ],
        ];
    }

    /**
     * @param  array<string, mixed>|array<int, string>  $requires
     * @return array{composer: array<int, string>, npm: array<int, string>}
     */
    protected function normalizeRequires(array $requires): array
    {
        if (array_is_list($requires)) {
            return [
                'composer' => $requires,
                'npm' => [],
            ];
        }

        return [
            'composer' => array_values(array_filter($requires['composer'] ?? [], 'is_string')),
            'npm' => array_values(array_filter($requires['npm'] ?? [], 'is_string')),
        ];
    }

    /**
     * Get component data including file contents
     */
    protected function getComponentDataWithFiles(string $name, string $version): array
    {
        $metadata = $this->getComponentMetadata($name, $version);
        if (! $metadata) {
            return [];
        }

        $sourceVersion = $this->resolveSourceVersion($name, $version);
        if ($sourceVersion === null) {
            $metadata['files'] = [];

            return $metadata;
        }

        $versionPath = $this->componentsPath.'/'.$name.'/'.$sourceVersion;
        $files = $this->getComponentFiles($name, $versionPath);

        $metadata['files'] = $files;

        return $metadata;
    }

    protected function resolveSourceVersion(string $name, string $requestedVersion): ?string
    {
        $requestedPath = $this->componentsPath.'/'.$name.'/'.$requestedVersion;
        if (is_dir($requestedPath)) {
            return $requestedVersion;
        }

        $versionsData = $this->getVersionsData($name);
        if (! $versionsData) {
            return null;
        }

        foreach ($versionsData['versions'] as $candidateVersion) {
            $candidatePath = $this->componentsPath.'/'.$name.'/'.$candidateVersion;
            if (is_dir($candidatePath)) {
                return $candidateVersion;
            }
        }

        return null;
    }

    /**
     * Get component files with their full content
     */
    protected function getComponentFiles(string $name, string $versionPath): array
    {
        $files = [];
        $filesInDir = glob($versionPath.'/*');
        $bladeFiles = [];

        // First pass: collect all files and identify blade files
        foreach ($filesInDir as $filePath) {
            $filename = basename($filePath);

            if (str_ends_with($filename, '.blade.php')) {
                $bladeFiles[] = $filename;
            } elseif (str_ends_with($filename, '.js')) {
                $files['resources/js/ui'.'/'.$filename] = file_get_contents($filePath);
            } elseif (str_ends_with($filename, '.css')) {
                $files['resources/css/ui/'.'/'.$filename] = file_get_contents($filePath);
            }
        }

        // Handle blade files based on component structure
        if (count($bladeFiles) === 1) {
            // Simple component: single file goes directly in ui/ folder
            $filename = $bladeFiles[0];
            $componentFileName = $name.'.blade.php';
            $files['resources/views/components/ui/'.$componentFileName] = file_get_contents($versionPath.'/'.$filename);
        } else {
            // Complex component: multiple files go in a subfolder
            foreach ($bladeFiles as $filename) {
                $files['resources/views/components/ui/'.$name.'/'.$filename] = file_get_contents($versionPath.'/'.$filename);
            }
        }

        return $files;
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

    /**
     * Get the filesystem path for a component
     */
    public function getComponentPath(string $name): string
    {
        return $this->componentsPath.'/'.$name;
    }

    /**
     * Get component metadata (alias for getComponentMetadata without version)
     */
    public function getMetadata(string $name): array
    {
        return $this->getComponentMetadata($name) ?? [];
    }

    /**
     * Check if component exists (alias for componentExists)
     */
    public function exists(string $name): bool
    {
        return $this->componentExists($name);
    }
}
