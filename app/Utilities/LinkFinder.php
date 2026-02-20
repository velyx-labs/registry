<?php

declare(strict_types=1);

namespace App\Utilities;

class LinkFinder
{
    protected array $config;

    public function __construct(array $config = [])
    {
        $this->config = $config;
    }

    public function processHtml(string $html): string
    {
        // Add target="_blank" and rel="nofollow" to all external links
        return preg_replace_callback(
            '/<a\s+([^>]*href=["\']?(https?:\/\/[^"\'\s>]*)["\']?[^>]*)>/i',
            function ($matches) {
                $linkTag = $matches[0];
                $href = $matches[2];

                // Check if it's an external link
                if ($this->isExternalLink($href)) {
                    $attrs = $this->config['attrs'] ?? [
                        'target' => '_blank',
                        'rel' => 'nofollow',
                    ];

                    // Add target if not present
                    if (! str_contains($linkTag, 'target=')) {
                        $linkTag = str_replace('<a ', '<a target="'.$attrs['target'].'" ', $linkTag);
                    }

                    // Add rel if not present
                    if (! str_contains($linkTag, 'rel=')) {
                        $linkTag = str_replace('<a ', '<a rel="'.$attrs['rel'].'" ', $linkTag);
                    }
                }

                return $linkTag;
            },
            $html
        );
    }

    protected function isExternalLink(string $url): bool
    {
        $currentHost = parse_url(config('app.url'), PHP_URL_HOST);
        $linkHost = parse_url($url, PHP_URL_HOST);

        return $linkHost !== null && $linkHost !== $currentHost;
    }
}
