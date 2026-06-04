<?php

use App\Services\ComponentService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Livewire\Component;

new class extends Component
{
    public array $components = [];
    public int $stars = 0;

    public function mount(ComponentService $componentService): void
    {
        $this->components = $componentService->getAllComponents();
        $this->stars = Cache::remember('github_stars_velyx', 3600, function () {
            $response = Http::withHeaders(['Accept' => 'application/vnd.github+json'])
                ->timeout(5)
                ->get('https://api.github.com/repos/velyx-labs/registry');

            return $response->successful() ? (int) $response->json('stargazers_count', 0) : 0;
        });
    }
};
?>

<div>

    {{-- Hero section: warm DESIGN.md palette override, light-mode first per spec --}}
    <style>
        .velyx-hero {
            --background: #f2f1ed;
            --foreground: #26251e;
            --muted: #ebeae5;
            --muted-foreground: #6b6a62;
            --border: #d5d3cc;
            --card: #f9f8f4;
        }
        .dark .velyx-hero {
            --background: oklch(0.145 0 0);
            --foreground: oklch(0.985 0 0);
            --muted: oklch(0.269 0 0);
            --muted-foreground: oklch(0.708 0 0);
            --border: oklch(1 0 0 / 10%);
            --card: oklch(0.205 0 0);
        }
    </style>

    {{-- ─── HERO ──────────────────────────────────────────────────────────── --}}
    <section class="velyx-hero relative min-h-screen flex flex-col items-center justify-center overflow-hidden px-6 py-24 lg:px-12 xl:px-24"
             style="background: var(--background); color: var(--foreground);">

        {{-- Dot grid background --}}
        <div class="pointer-events-none absolute inset-0 opacity-[0.06]"
             style="background-image: radial-gradient(var(--foreground) 1px, transparent 1px); background-size: 24px 24px;"></div>
        {{-- Radial fade: dots visible in center, fade to background at edges --}}
        <div class="pointer-events-none absolute inset-0"
             style="background: radial-gradient(ellipse 70% 60% at 50% 50%, transparent 20%, var(--background) 70%);"></div>

        {{-- ── Text block ── --}}
        <div class="relative z-10 w-full max-w-3xl mx-auto flex flex-col items-center text-center space-y-8">

            {{-- Eyebrow badge with brand orange --}}
            <div class="inline-flex items-center gap-2 rounded-full px-3.5 py-1.5 text-xs font-medium"
                 style="border: 1px solid var(--border); background: var(--muted); color: var(--muted-foreground);">
                <span class="size-1.5 rounded-full" style="background: #f54e00; box-shadow: 0 0 0 3px rgba(245,78,0,0.15);"></span>
                Production-ready Blade components
            </div>

            {{-- Headline: extrabold display + shadcn weight-contrast treatment --}}
            <h1 class="text-[clamp(3.5rem,9vw,7.5rem)] font-extrabold leading-[0.88] tracking-[-0.03em]"
                style="color: var(--foreground);">
                Copy&nbsp;once.<br>
                <span class="font-light" style="color: var(--foreground); opacity: 0.35;">own&nbsp;forever.</span>
            </h1>

            {{-- Body --}}
            <p class="max-w-[46ch] text-lg leading-relaxed" style="color: var(--muted-foreground);">
                Production-ready components for Laravel. Copy them into your codebase, adapt them freely.
                No vendor lock-in, no runtime surprises.
            </p>

            {{-- CTAs --}}
            <div class="flex flex-wrap justify-center items-center gap-3">
                <x-ui.button href="{{ route('docs.page', 'installation') }}" wire:navigate size="lg" iconRight="arrow-right">
                    Get started
                </x-ui.button>
                <x-ui.button href="{{ route('docs.page', 'components') }}" wire:navigate variant="outline" size="lg">
                    Browse {{ count($this->components) }} components
                </x-ui.button>
            </div>

            {{-- GitHub stars --}}
            <a
                href="https://github.com/velyx-labs/registry"
                target="_blank"
                rel="noopener noreferrer"
                class="inline-flex items-center gap-2 text-sm transition-colors"
                style="color: var(--muted-foreground); opacity: 0.65;"
                onmouseover="this.style.opacity='1'"
                onmouseout="this.style.opacity='0.65'"
            >
                <x-lucide-star class="size-3.5" />
                @if($stars > 0)
                    <strong class="font-semibold" style="color: var(--foreground);">{{ number_format($stars) }}</strong> stars on GitHub
                @else
                    Star us on GitHub
                @endif
            </a>
        </div>

        {{-- ── Terminal: below text block, centered, max-width contained ── --}}
        <div class="relative z-10 w-full max-w-xl mx-auto mt-14">
            <div class="rounded-xl overflow-hidden"
                 style="border: 1px solid var(--border); background: var(--card); box-shadow: 0 25px 50px -12px rgba(38,37,30,0.12), 0 0 0 1px rgba(38,37,30,0.04);">

                {{-- Terminal chrome — macOS-style traffic lights --}}
                <div class="flex items-center gap-2 px-4 py-3"
                     style="border-bottom: 1px solid var(--border); background: var(--muted);">
                    <span class="size-2.5 rounded-full bg-red-400/80"></span>
                    <span class="size-2.5 rounded-full bg-amber-400/80"></span>
                    <span class="size-2.5 rounded-full bg-green-400/80"></span>
                    <span class="ml-3 font-mono text-xs" style="color: var(--muted-foreground); opacity: 0.6;">~/my-laravel-app</span>
                </div>

                {{-- Terminal output --}}
                <div class="p-5 font-mono text-sm leading-relaxed space-y-4">

                    <div class="space-y-1.5">
                        <div class="flex gap-2">
                            <span class="select-none" style="color: var(--foreground); opacity: 0.25;">❯</span>
                            <span style="color: var(--foreground);">npx velyx@latest init</span>
                        </div>
                        <div class="pl-5 space-y-0.5 text-xs">
                            <div class="text-green-600 dark:text-green-400">✓ Detected Laravel 12 project</div>
                            <div class="text-green-600 dark:text-green-400">✓ Tailwind CSS v4 configured</div>
                            <div class="text-green-600 dark:text-green-400">✓ Saved velyx.json</div>
                        </div>
                    </div>

                    <div class="space-y-1.5">
                        <div class="flex gap-2">
                            <span class="select-none" style="color: var(--foreground); opacity: 0.25;">❯</span>
                            <span style="color: var(--foreground);">npx velyx@latest add button field</span>
                        </div>
                        <div class="pl-5 space-y-0.5 text-xs">
                            <div class="flex items-center gap-2">
                                <span class="text-green-600 dark:text-green-400">✓</span>
                                <span style="color: var(--foreground);">button.blade.php</span>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-green-600 dark:text-green-400">✓</span>
                                <span style="color: var(--foreground);">field/index.blade.php</span>
                            </div>
                            <div class="pt-1" style="color: var(--muted-foreground); opacity: 0.55;">2 components copied — they're yours now.</div>
                        </div>
                    </div>

                    <div class="flex gap-2 items-center">
                        <span class="select-none" style="color: var(--foreground); opacity: 0.25;">❯</span>
                        <span class="inline-block w-1.5 h-[1.1em] animate-pulse rounded-[1px]"
                              style="background: var(--foreground); opacity: 0.45;"></span>
                    </div>

                </div>
            </div>

            {{-- Support nudge below terminal --}}
            <p class="mt-3 text-xs text-center" style="color: var(--muted-foreground); opacity: 0.45;">
                Built with care ·
                <a href="https://gvcjmaad.mychariow.shop/velyx-dev" target="_blank" rel="noopener noreferrer"
                   class="underline decoration-dotted underline-offset-2 transition-opacity hover:opacity-80"
                   style="color: inherit;">
                    support the project
                </a>
            </p>
        </div>

    </section>

        <x-ui.separator />

    {{-- ─── WHY VELYX ─────────────────────────────────────────────────────── --}}
    <section class="py-24 px-6 lg:px-12 xl:px-24">
        <div class="max-w-7xl mx-auto grid md:grid-cols-3 gap-12 lg:gap-16 xl:gap-20">

            @foreach([
                ['01', 'Copy, not install.', 'Components live in your project directory. Commit them, diff them, modify them. They are source files, not a black box.'],
                ['02', 'Pure PHP and Blade.', 'No JavaScript runtime required. No magic abstractions. Read the code, understand it, debug it in plain sight.'],
                ['03', 'Start and adapt.', "Sensible defaults out of the box. Swap in your own design tokens when you're ready. Every project is different."],
            ] as [$num, $title, $body])
            <div class="space-y-4">
                <span class="font-mono text-xs text-muted-foreground/50 tracking-wider">{{ $num }}</span>
                <h3 class="text-xl font-semibold tracking-tight text-foreground">{{ $title }}</h3>
                <p class="text-muted-foreground leading-relaxed text-[0.9375rem]">{{ $body }}</p>
            </div>
            @endforeach

        </div>
    </section>

    <x-ui.separator />

    {{-- ─── COMPONENT SHOWCASE ─────────────────────────────────────────────── --}}
    <section class="py-24 px-6 lg:px-12 xl:px-24">
        <div class="max-w-7xl mx-auto">

            <div class="flex items-end justify-between mb-10">
                <div class="space-y-1.5">
                    <p class="font-mono text-xs text-muted-foreground/50 tracking-wider uppercase">Library</p>
                    <h2 class="text-3xl font-semibold tracking-tight text-foreground">Everything you need.</h2>
                </div>
                <x-ui.button href="{{ route('docs.page', 'components') }}" wire:navigate variant="outline" iconRight="arrow-right">
                    All {{ count($this->components) }} components
                </x-ui.button>
            </div>

            {{-- Flush grid of live component specimens --}}
            <div class="border border-border rounded-xl overflow-hidden grid sm:grid-cols-2 lg:grid-cols-3 divide-y divide-border sm:divide-x">

                {{-- Buttons --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Button</span>
                    <div class="flex flex-wrap gap-2 pt-1">
                        <x-ui.button size="sm">Primary</x-ui.button>
                        <x-ui.button size="sm" variant="outline">Outline</x-ui.button>
                        <x-ui.button size="sm" variant="ghost">Ghost</x-ui.button>
                    </div>
                </div>

                {{-- Badges --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Badge</span>
                    <div class="flex flex-wrap gap-2 pt-1">
                        <x-ui.badge>Default</x-ui.badge>
                        <x-ui.badge variant="secondary">Secondary</x-ui.badge>
                        <x-ui.badge variant="success">New</x-ui.badge>
                        <x-ui.badge variant="outline">Outline</x-ui.badge>
                    </div>
                </div>

                {{-- Field + Input --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Field</span>
                    <div class="pt-1">
                        <x-ui.field>
                            <x-ui.field.label>Email address</x-ui.field.label>
                            <x-ui.field.content>
                                <x-ui.input placeholder="you@example.com" />
                            </x-ui.field.content>
                        </x-ui.field>
                    </div>
                </div>

                {{-- Checkbox --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Checkbox</span>
                    <div class="pt-1 space-y-3">
                        <label class="flex items-center gap-2.5 cursor-pointer text-sm text-foreground">
                            <x-ui.checkbox checked />
                            <span>Email notifications</span>
                        </label>
                        <label class="flex items-center gap-2.5 cursor-pointer text-sm text-muted-foreground">
                            <x-ui.checkbox />
                            <span>Marketing updates</span>
                        </label>
                    </div>
                </div>

                {{-- Progress --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Progress</span>
                    <div class="pt-1 space-y-3">
                        <x-ui.progress-bar :percentage="72" label="72%" />
                        <x-ui.progress-bar :percentage="30" label="30%" />
                    </div>
                </div>

                {{-- Avatar --}}
                <div class="p-8 bg-card space-y-4">
                    <span class="font-mono text-xs text-muted-foreground/50">Avatar</span>
                    <div class="pt-1 flex items-center gap-2">
                        <x-ui.avatar size="lg">
                            <x-ui.avatar.image src="https://i.pravatar.cc/80?img=3" alt="Jordan D." />
                        </x-ui.avatar>
                        <x-ui.avatar>
                            <x-ui.avatar.image src="https://i.pravatar.cc/80?img=15" alt="Alex K." />
                        </x-ui.avatar>
                        <x-ui.avatar size="sm">
                            <x-ui.avatar.image src="https://i.pravatar.cc/80?img=44" alt="Maria R." />
                        </x-ui.avatar>
                    </div>
                </div>

            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ─── HOW IT WORKS ───────────────────────────────────────────────────── --}}
    <section class="py-24 px-6 lg:px-12 xl:px-24">
        <div class="max-w-7xl mx-auto">

            <div class="mb-12 space-y-1.5">
                <p class="font-mono text-xs text-muted-foreground/50 tracking-wider uppercase">Workflow</p>
                <h2 class="text-3xl font-semibold tracking-tight text-foreground">Three commands. Done.</h2>
            </div>

            <div class="grid md:grid-cols-3 gap-8">

                @foreach([
                    ['01', 'Init your project', 'npx velyx@latest init', 'Detects your Laravel stack, writes a velyx.json config.'],
                    ['02', 'Pick components', 'npx velyx@latest add button', 'Files land in your codebase. Commit and own them.'],
                    ['03', 'Or add many at once', 'npx velyx@latest add button field input', 'Mix and match. Each run is idempotent.'],
                ] as [$step, $title, $command, $description])
                <div class="space-y-4">
                    <div class="flex items-center gap-3">
                        <span class="font-mono text-xs text-muted-foreground/50">{{ $step }}</span>
                        <span class="h-px flex-1 bg-border"></span>
                    </div>
                    <h3 class="font-semibold text-foreground">{{ $title }}</h3>
                    <div class="rounded-lg bg-muted px-4 py-3 font-mono text-sm text-foreground">
                        <span class="text-muted-foreground select-none mr-2">$</span>{{ $command }}
                    </div>
                    <p class="text-sm text-muted-foreground leading-relaxed">{{ $description }}</p>
                </div>
                @endforeach

            </div>
        </div>
    </section>

    <x-ui.separator />

    {{-- ─── FINAL CTA ──────────────────────────────────────────────────────── --}}
    <section class="py-32 px-6 lg:px-12 xl:px-24">
        <div class="max-w-7xl mx-auto max-w-2xl space-y-8">
            <span class="block h-px w-8 bg-foreground/25"></span>
            <h2 class="text-[clamp(2rem,5vw,3.5rem)] font-bold leading-[1.05] tracking-tight text-foreground">
                Your components,<br>
                <span class="font-light text-muted-foreground">your codebase.</span>
            </h2>
            <p class="text-lg text-muted-foreground leading-relaxed">
                Stop fighting black-box component libraries. Copy the code in, make it yours, ship with confidence.
            </p>
            <div class="flex flex-wrap gap-3">
                <x-ui.button href="{{ route('docs.page', 'installation') }}" wire:navigate size="lg" iconRight="arrow-right">
                    Start building
                </x-ui.button>
                <x-ui.button href="{{ route('docs.page', 'components') }}" wire:navigate variant="outline" size="lg">
                    Browse components
                </x-ui.button>
            </div>
        </div>
    </section>

</div>
