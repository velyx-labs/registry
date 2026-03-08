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
        return (new \App\Utilities\LinkFinder([
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
