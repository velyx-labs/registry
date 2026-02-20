<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Symfony\Component\HttpFoundation\Response;

class DocsController extends Controller
{
    private string $docsPath;

    public function __construct()
    {
        $this->docsPath = resource_path('docs');
    }

    public function show(Request $request, ?string $page = 'introduction'): Response
    {
        $validPages = array_keys(config('docs.navigation.getting_started.pages', []));

        // Default to introduction if no page specified
        if (empty($page)) {
            $page = 'introduction';
        }

        // Validate page exists
        if (! in_array($page, $validPages, true)) {
            abort(404);
        }

        $content = $this->getMarkdownContent("getting-started/{$page}.md");
        $navigation = $this->buildNavigation();
        $currentPage = $page;
        $title = config("docs.navigation.getting_started.pages.{$page}.title", 'Documentation');

        return response()
            ->view('docs.show', compact('content', 'navigation', 'currentPage', 'title', 'page'))
            ->header('Cache-Control', 'public, max-age=3600');
    }

    public function component(Request $request, string $component): Response
    {
        $slug = str_replace('-', '', $component);
        $validComponents = array_keys(config('docs.navigation.components.library', []));

        // Find component by slug (case-insensitive, ignores hyphens)
        $componentKey = collect($validComponents)
            ->first(fn(string $key) => str_replace('-', '', $key) === $slug);

        if (! $componentKey) {
            abort(404);
        }

        $content = $this->getMarkdownContent("components/{$componentKey}.md");
        $navigation = $this->buildNavigation();
        $currentPage = $componentKey;
        $title = config("docs.navigation.components.library.{$componentKey}.title", 'Component');

        return response()
            ->view('docs.show', compact('content', 'navigation', 'currentPage', 'title', 'component'))
            ->header('Cache-Control', 'public, max-age=3600');
    }

    private function getMarkdownContent(string $path): string
    {
        $fullPath = "{$this->docsPath}/{$path}";

        if (! File::exists($fullPath)) {
            return $this->generatePlaceholderContent($path);
        }

        return File::get($fullPath);
    }

    private function generatePlaceholderContent(string $path): string
    {
        // Extract page/component name from path
        $name = pathinfo($path, PATHINFO_FILENAME);
        $type = str_contains($path, 'components/') ? 'Component' : 'Page';

        return "# {$name}\n\nDocumentation for {$name} {$type} is coming soon.\n\nCheck back later for detailed documentation, examples, and usage guidelines.";
    }

    private function buildNavigation(): array
    {
        return [
            'getting_started' => config('docs.navigation.getting_started', []),
            'components' => config('docs.navigation.components', []),
        ];
    }
}
