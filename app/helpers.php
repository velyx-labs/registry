<?php

declare(strict_types=1);

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Support\Facades\Auth;
use League\CommonMark\Output\RenderedContentInterface;

if (! function_exists('active')) {
    /**
     * @param  array<string>  $routes
     */
    function active(array $routes, string $activeClass = 'active', string $defaultClass = '', bool $condition = true): string
    {
        return call_user_func_array([app('router'), 'is'], $routes) && $condition ? $activeClass : $defaultClass;
    }
}

if (! function_exists('is_active')) {
    /**
     * Determines if the given routes are active.
     */
    function is_active(string ...$routes): bool
    {
        return (bool) call_user_func_array([app('router'), 'is'], (array) $routes);
    }
}

if (! function_exists('md_to_html')) {
    function md_to_html(string $markdown): RenderedContentInterface
    {
        return Markdown::convert($markdown);
    }
}

if (! function_exists('replace_links')) {
    function replace_links(string $markdown): string
    {
        return (new LinkFinder([
            'attrs' => ['target' => '_blank', 'rel' => 'nofollow'],
        ]))->processHtml($markdown);
    }
}

if (! function_exists('get_current_theme')) {
    function get_current_theme(): string
    {
        return Auth::user() ?
            Auth::user()->setting('theme', 'light') :
            'light';
    }
}

if (! function_exists('canonical')) {
    /**
     * @param  array<string>  $params
     */
    function canonical(string $route, array $params = []): string
    {
        $page = app('request')->get('page');
        $params = array_merge($params, ['page' => $page !== 1 ? $page : null]);

        ksort($params);

        return route($route, $params);
    }
}

if (! function_exists('get_resource_content')) {
    /**
     * Get file content from resources directory
     *
     * @param  string  $path  Path relative to resources directory
     * @return string File content or empty string if file doesn't exist
     */
    function get_resource_content(string $path): string
    {
        $fullPath = resource_path($path);

        if (! file_exists($fullPath)) {
            return '';
        }

        return file_get_contents($fullPath);
    }
}

if (! function_exists('is_docs_page_active')) {
    /**
     * Check if a docs page is active
     */
    function is_docs_page_active(string $page): bool
    {
        return request()->routeIs('docs.show') && request()->route('page') === $page;
    }
}

if (! function_exists('is_component_active')) {
    /**
     * Check if a component page is active
     */
    function is_component_active(string $component): bool
    {
        return request()->routeIs('components.show') && request()->route('component') === str($component)->slug()->value;
    }
}

if (! function_exists('get_component_items')) {
    /**
     * Get the list of component names for navigation
     */
    function get_component_items(): array
    {
        return array_keys(config('docs.navigation.components.library', []));
    }
}

if (! function_exists('get_component_description')) {
    /**
     * Get description for a specific component
     */
    function get_component_description(string $component): string
    {
        return config('docs.navigation.components.library.'.$component.'.description', 'Beautiful, accessible component');
    }
}

if (! function_exists('get_component_categories')) {
    /**
     * Get components organized by categories
     */
    function get_component_categories(): array
    {
        $library = config('docs.navigation.components.library', []);
        $categories = [];

        foreach ($library as $component => $data) {
            $category = $data['category'] ?? 'Other';
            $categories[$category][] = $component;
        }

        // Sort categories and components within each category
        ksort($categories);
        foreach ($categories as $category => $components) {
            sort($categories[$category]);
        }

        return $categories;
    }
}

if (! function_exists('get_docs_navigation')) {
    /**
     * Get the complete docs navigation structure
     */
    function get_docs_navigation(): array
    {
        return config('docs.navigation', []);
    }
}

if (! function_exists('get_getting_started_pages')) {
    /**
     * Get getting started pages
     */
    function get_getting_started_pages(): array
    {
        return config('docs.navigation.getting_started.pages', []);
    }
}

if (! function_exists('get_getting_started_title')) {
    /**
     * Get getting started section title
     */
    function get_getting_started_title(): string
    {
        return config('docs.navigation.getting_started.title', 'Getting Started');
    }
}

if (! function_exists('get_components_title')) {
    /**
     * Get components section title
     */
    function get_components_title(): string
    {
        return config('docs.navigation.components.title', 'Components');
    }
}
