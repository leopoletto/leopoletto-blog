<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Primary Meta -->
    <title>{{ $page->head('title') }}</title>
    <link rel="canonical" href="{{ rtrim($page->getUrl(), '/') }}">
    <meta name="description" content="{{ $page->head('description') }}">
    <meta name="author" content="{{ $page->head('author') }}">

    <!-- Open Graph -->
    <meta property="og:title" content="{{ $page->head('og:title') }}">
    <meta property="og:type" content="{{ $page->head('og:type') }}">
    <meta property="og:url" content="{{ rtrim($page->getUrl(), '/')  }}">
    <meta property="og:locale" content="{{ $page->head('language') }}">
    <meta property="og:image" content="{{ $page->head('og:image') }}">
    <meta property="og:logo" content="{{ $page->head('og:logo') }}">
    <meta property="og:description" content="{{ $page->head('og:description') }}">

    <!-- Twitter / X Meta -->
    <meta name="twitter:card" content="{{ $page->head('x:card') }}">
    <meta name="twitter:site" content="{{ $page->head('x:site') }}">
    <meta name="twitter:creator" content="{{ $page->head('x:creator') }}">
    <meta name="twitter:title" content="{{ $page->head('x:title') }}">
    <meta name="twitter:description" content="{{ $page->head('x:description') }}">
    <meta name="twitter:image" content="{{ $page->head('x:image') }}">

    <!-- Favicons & Manifest -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ $page->head('favicon:apple') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ $page->head('favicon:32') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $page->head('favicon:16') }}">
    <link rel="mask-icon" href="{{ $page->head('favicon:mask') }}" color="{{ $page->head('manifest:color') }}">
    <meta name="msapplication-TileColor" content="{{ $page->head('manifest:color') }}">
    <meta name="theme-color" content="{{ $page->head('manifest:color') }}">
    <link rel="manifest" href="{{ $page->head('manifest:file') }}">
    <link rel="home" href="{{ str($page->baseUrl)->beforeLast('/') }}">

    <!-- Atom Feed -->
    <link href="{{ $page->head('feed:atom') }}" type="application/atom+xml" rel="alternate"
          title="{{ $page->general['siteName'] }} Feed">

    <link href="{{ $page->asset('assets/fonts/jetbrains-mono.css') }}" rel="stylesheet">
    <link href="{{ $page->asset('assets/fonts/merriweather.css')  }}" rel="stylesheet">

    @if ($page->production)
    <!-- Plausible Analytics -->
    <script defer data-domain="leopoletto.dev"
            src="https://plausible.io/js/script.file-downloads.hash.outbound-links.tagged-events.js"></script>
    @endif
    @viteRefresh()
    <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
    <!-- External Links Arrow -->
    <style>
        .prose a[href^="http"]:not([href*="{{ $page->baseUrl  }}"])::after {
            opacity: 0.7;
            margin-left: 0.25rem;
            font-size: 1rem;
            color: var(--color-brand-primary-100);
            content: '↗';
        }
    </style>
    <script defer type="module" src="{{ vite('source/_assets/js/main.js') }}"></script>
</head>
<body class="min-h-screen bg-white font-sans">

<header x-data="{ light: true }" class="py-10 px-5 flex items-center">
    <div class="container items-center justify-center mx-auto flex max-w-6xl flex-col gap-2 md:flex-row md:gap-10">
        <div class="hidden md:block border-2 relative group border-brand-secondary-500/40 rounded-3xl p-2 md:overflow-clip">
            <a href="{{ $page->baseUrl }}"
               :class="{'motion-safe:animate-insight': light}"
               class="relative z-30 rounded-2xl self-baseline md:block md:w-fit md:overflow-clip">
                <img alt="{{$page->general['picture']['alt']}}"
                     class="-scale-x-100 w-[200px] rounded-2xl md:w-[200px] md:min-w-[200px]"
                     src="{{ str($page->baseUrl)->append($page->general['picture']['src']) }}"/>
            </a>
            <span class="transition-all backdrop-blur-md backdrop-saturate-100 backdrop-xs backdrop-brightness-150 w-full aspect-square absolute left-0 top-0 z-20"></span>
            <span style="background-image: url('{{ $page->asset('assets/img/profile-resized-240.webp')  }}')" class="bg-photo bg-cover w-full aspect-square absolute left-0 top-0 z-10"></span>
        </div>
        <div class="w-fit min-h-max">
            <span>
                <a class="font-semibold text-brand-secondary-100 text-3xl font-serif"
                   href="{{ $page->baseUrl }}">{{ $page->general['author']  }}</a>
            </span>
            <div class="mt-5 description">
                <x-partials.short-about/>
                <x-partials.main-nav
                        github="https://github.com/leopoletto/"
                        linkedin="https://www.linkedin.com/in/leopoletto/"
                        x="https://x.com/leopoletto"
                        atom="{{ str($page->baseUrl)->append('blog/feed.atom') }}"
                >
                    <x-slot:links>
                        <ul class="flex gap-3 md:gap-5 ml-3">
                            <li>
                                <x-partials.menu-link
                                        href="{{ str($page->baseUrl)->append('blog/about')  }}"
                                        title="About Leonardo Poletto"
                                >About
                                </x-partials.menu-link>
                            </li>
                            <li>
                                <x-partials.menu-link
                                        href="{{ str($page->baseUrl)->append('blog/resume')  }}"
                                        title="Leonardo Poletto's Resume"
                                >Resume
                                </x-partials.menu-link>
                            </li>
                            <li>
                                <x-partials.menu-link href="{{ str($page->baseUrl)->append('categories/open-lab')  }}"
                                                      title="Learn more about tools">Open Lab
                                </x-partials.menu-link>
                            </li>
                        </ul>
                    </x-slot:links>
                </x-partials.main-nav>
            </div>
        </div>
    </div>
</header>

<main class="container mx-auto w-full max-w-5xl px-5 flex-auto overflow-hidden">
    @yield('body')
</main>

<footer class="px-6 py-6 text-center border-t border-t-brand-secondary-400 md:px-0">
    <ul class="flex flex-col md:flex-row gap-5 justify-center items-center">
        <li class="text-base text-brand-secondary-100">
            Built with purpose. Maintained with integrity.
        </li>
    </ul>
</footer>
</body>
</html>
