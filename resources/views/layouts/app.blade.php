<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
          content="Build beautiful design systems with Velyx - a comprehensive collection of beautifully designed, accessible components for modern web applications.">
    <meta name="keywords"
          content="UI components, design system, Laravel, Livewire, Tailwind CSS, accessible components">
    <meta name="author" content="Velyx Team">

    <title>{{ $title ?? 'Velyx - Beautiful Design Systems' }}</title>
    @include('partials.head')
    @livewireStyles

    <!-- Custom CSS for animations -->
    <style>
        @keyframes fade-in {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        @keyframes fade-in-up {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animate-fade-in {
            animation: fade-in 0.8s ease-out forwards;
        }

        .animate-fade-in-up {
            animation: fade-in-up 0.8s ease-out forwards;
            animation-delay: 0.2s;
            opacity: 0;
        }

        .animate-fade-in-up:nth-child(2) {
            animation-delay: 0.4s;
        }

        .animate-fade-in-up:nth-child(3) {
            animation-delay: 0.6s;
        }


        /* Better responsive typography scaling */
        @media (min-width: 1920px) {
            .text-\[10rem\] {
                font-size: 10rem;
                line-height: 1;
            }
        }
    </style>
</head>
<body class="bg-background text-foreground min-h-screen antialiased">
<livewire:partials.header />
{{ $slot }}
<livewire:partials.footer />
<!-- Livewire Scripts -->
@livewireScripts

<!-- Initialize theme -->
<script>
    // Theme initialization
    if (localStorage.getItem('theme') === 'dark' || (!localStorage.getItem('theme') && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Smooth scrolling for anchor links
    document.addEventListener('DOMContentLoaded', function () {
        const links = document.querySelectorAll('a[href^="#"]');
        links.forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    });
</script>
</body>
</html>
