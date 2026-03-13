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
