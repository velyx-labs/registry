<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | Preview Registry URL
    |--------------------------------------------------------------------------
    |
    | The base URL for the registry application. This is used in the docs
    | site to generate iframe URLs for component previews.
    |
    */

    'registry_url' => env('PREVIEW_REGISTRY_URL', env('APP_URL', 'http://localhost:8000')),

    /*
    |--------------------------------------------------------------------------
    | Token TTL
    |--------------------------------------------------------------------------
    |
    | The default time-to-live for preview tokens in seconds. After this time,
    | preview tokens will expire and need to be regenerated.
    |
    */

    'token_ttl' => env('PREVIEW_TOKEN_TTL', 3600), // 1 hour

    /*
    |--------------------------------------------------------------------------
    | Sandbox Attributes
    |--------------------------------------------------------------------------
    |
    | The sandbox attributes to apply to preview iframes. These control
    | what permissions the preview has within the iframe context.
    |
    | Available options:
    | - allow-scripts: Allow JavaScript execution
    | - allow-same-origin: Allow same-origin requests
    | - allow-forms: Allow form submission
    | - allow-popups: Allow popups and window.open()
    | - allow-modals: Allow modal dialogs
    |
    */

    'sandbox_attributes' => 'allow-scripts allow-same-origin allow-forms',

    /*
    |--------------------------------------------------------------------------
    | Default Preview Height
    |--------------------------------------------------------------------------
    |
    | The default height for preview iframes when not explicitly set.
    | Can be any valid CSS height value.
    |
    */

    'default_height' => env('PREVIEW_DEFAULT_HEIGHT', '400px'),

    /*
    |--------------------------------------------------------------------------
    | Interactive Components
    |--------------------------------------------------------------------------
    |--------------------------------------------------------------------------
    |
    | Components that require special interactive handling. These components
    | will use the interactive preview template with trigger buttons and
    | Alpine.js integration.
    |
    */

    'interactive_components' => [
        'modal',
        'drawer',
        'dropdown',
        'alert',
        'tooltip',
        'popover',
        'dialog',
        'confirmation-dialog',
    ],

    /*
    |--------------------------------------------------------------------------
    | Preview Variants
    |--------------------------------------------------------------------------
    |
    | Default variants that can be used across components. Components can
    | override these in their preview.json file.
    |
    */

    'default_variants' => [
        'default' => [],
        'primary' => ['variant' => 'primary'],
        'secondary' => ['variant' => 'secondary'],
        'destructive' => ['variant' => 'destructive'],
        'outline' => ['variant' => 'outline'],
        'ghost' => ['variant' => 'ghost'],
    ],

    /*
    |--------------------------------------------------------------------------
    | Cache Settings
    |--------------------------------------------------------------------------
    |
    | Configure caching for preview renders and component metadata.
    |
    */

    'cache' => [
        'enabled' => env('PREVIEW_CACHE_ENABLED', true),
        'ttl' => env('PREVIEW_CACHE_TTL', 300), // 5 minutes
    ],

    /*
    |--------------------------------------------------------------------------
    | Allowed Props
    |--------------------------------------------------------------------------
    |
    | When generating preview tokens without explicit allowed props, these
    | props will be allowed by default. Set to empty array to allow all props.
    |
    */

    'default_allowed_props' => [
        'variant',
        'size',
        'color',
        'disabled',
        'class',
    ],

    /*
    |--------------------------------------------------------------------------
    | Preview Security
    |--------------------------------------------------------------------------
    |
    | Security settings for the preview system.
    |
    */

    'security' => [
        /*
         * Require HTTPS for preview URLs in production.
         */
        'require_https' => env('PREVIEW_REQUIRE_HTTPS', env('APP_ENV') === 'production'),

        /*
         * Maximum number of preview tokens that can be generated per hour.
         */
        'rate_limit' => env('PREVIEW_RATE_LIMIT', 60),

        /*
         * Allowed origins for preview iframe requests.
         * Set to null to allow all origins (not recommended in production).
         */
        'allowed_origins' => env('PREVIEW_ALLOWED_ORIGINS'),
    ],
];
