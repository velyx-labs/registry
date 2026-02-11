<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class RegistryList extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registry:list {--format=table : Output format (table|json)} {--sort=name : Sort by field (name|latest|versions)}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'List all components in the registry';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $format = $this->option('format') ?? 'table';
        $sortBy = $this->option('sort') ?? 'name';

        if (! in_array($format, ['table', 'json'])) {
            $this->error("Invalid format: {$format}. Use table or json");

            return 1;
        }

        if (! in_array($sortBy, ['name', 'latest', 'versions'])) {
            $this->error("Invalid sort: {$sortBy}. Use name, latest, or versions");

            return 1;
        }

        $componentsPath = base_path('registry/components');

        if (! is_dir($componentsPath)) {
            $this->error('Registry directory not found');

            return 1;
        }

        $components = [];
        $componentDirs = glob($componentsPath.'/*', GLOB_ONLYDIR);

        foreach ($componentDirs as $componentPath) {
            $componentName = basename($componentPath);
            $componentData = $this->getComponentData($componentName);

            if ($componentData) {
                $components[] = $componentData;
            }
        }

        // Sort components
        usort($components, function ($a, $b) use ($sortBy) {
            switch ($sortBy) {
                case 'latest':
                    return version_compare($b['latest'], $a['latest']);
                case 'versions':
                    return count($b['versions']) - count($a['versions']);
                case 'name':
                default:
                    return strcasecmp($a['name'], $b['name']);
            }
        });

        if ($format === 'json') {
            $this->line(json_encode([
                'components' => $components,
                'total' => count($components),
                'sort' => $sortBy,
            ], JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES));
        } else {
            $this->displayTable($components);
        }

        $this->newLine();
        $this->info('Total: '.count($components).' components');

        return 0;
    }

    /**
     * Get component data from meta and versions files
     */
    private function getComponentData(string $name): ?array
    {
        $componentPath = base_path("registry/components/{$name}");

        // Get meta data
        $metaFile = $componentPath.'/meta.json';
        if (! file_exists($metaFile)) {
            return null;
        }

        $meta = json_decode(file_get_contents($metaFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        // Get versions data
        $versionsFile = $componentPath.'/versions.json';
        if (! file_exists($versionsFile)) {
            return null;
        }

        $versions = json_decode(file_get_contents($versionsFile), true);
        if (json_last_error() !== JSON_ERROR_NONE) {
            return null;
        }

        return [
            'name' => $name,
            'latest' => $versions['latest'] ?? 'unknown',
            'versions' => $versions['versions'] ?? [],
            'description' => $meta['description'] ?? '',
            'requires_alpine' => $meta['requires_alpine'] ?? false,
            'requires' => $meta['requires'] ?? [],
            'laravel' => $meta['laravel'] ?? '>=10',
        ];
    }

    /**
     * Display components in table format
     */
    private function displayTable(array $components): void
    {
        if (empty($components)) {
            $this->info('No components found in registry.');

            return;
        }

        $this->newLine();
        $this->info('📦 Registry Components:');
        $this->newLine();

        // Table headers
        $headers = [
            'Component',
            'Latest',
            'Versions',
            'Alpine',
            'Description',
        ];

        // Calculate column widths
        $maxName = max(9, max(array_map('strlen', array_column($components, 'name'))));
        $maxLatest = max(6, max(array_map('strlen', array_column($components, 'latest'))));
        $maxVersions = max(8, max(array_map(function ($v) {
            return (string) count($v);
        }, $components)));
        $maxAlpine = max(6, 8);
        $maxDesc = max(11, 50);

        // Header row
        $headerFormat = sprintf(
            "  %-{$maxName}s | %-{$maxLatest}s | %-{$maxVersions}s | %-{$maxAlpine}s | %-{$maxDesc}s",
            $headers[0], $headers[1], $headers[2], $headers[3], $headers[4]
        );
        $this->line($headerFormat);

        // Separator
        $separator = sprintf(
            '  %s-+-%s-+-%s-+-%s-+-%s',
            str_repeat('-', $maxName),
            str_repeat('-', $maxLatest),
            str_repeat('-', $maxVersions),
            str_repeat('-', $maxAlpine),
            str_repeat('-', $maxDesc)
        );
        $this->line($separator);

        // Data rows
        foreach ($components as $component) {
            $alpineStatus = $component['requires_alpine'] ? '✅' : '❌';
            $description = substr($component['description'], 0, $maxDesc);
            if (strlen($component['description']) > $maxDesc) {
                $description .= '...';
            }

            $rowFormat = sprintf(
                "  %-{$maxName}s | %-{$maxLatest}s | %-{$maxVersions}s | %-{$maxAlpine}s | %-{$maxDesc}s",
                $component['name'],
                $component['latest'],
                (string) count($component['versions']),
                $alpineStatus,
                $description
            );
            $this->line($rowFormat);
        }
    }
}
