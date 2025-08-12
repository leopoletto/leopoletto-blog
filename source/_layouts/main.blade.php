<!DOCTYPE html>
<html lang="{{ $page->language ?? 'en' }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">

    <title>{{  $page->title ?: $page->defaultTitle }}</title>
    <link rel="canonical" href="{{ str($page->getUrl())->beforeLast('/') }}"/>
    <meta name="description" content="{{ $page->description ?? $page->siteDescription }}">
    <meta name="author" content="Leonardo Poletto">

    <meta name="msapplication-TileColor" content="#0a0033">
    <meta name="theme-color" content="#0a0033">
    <meta property="og:title" content="{{ $page->title ?: $page->defaultTitle }}"/>
    <meta property="og:type" content="{{ $page->type ?? 'website' }}"/>
    <meta property="og:url" content="{{ str($page->getUrl())->beforeLast('/') }}"/>
    <meta property="og:locale" content="en"/>
    @if($page?->image)
        <meta property="og:image" content="{{$page->baseUrl . 'assets/images/og/' . $page->image}}"/>
        <meta property="og:logo" content="{{$page->baseUrl . 'assets/images/img/leopoleto.webp'}}"/>
        <meta property="og:image:alt" content="{{ $page->description ?? $page->siteDescription }}"/>
    @endif
    <meta property="og:description" content="{{ $page->description ?? $page->siteDescription }}"/>
    <!-- Twitter Meta Tags -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:site" content="@leopoletto">
    <meta name="twitter:id" content="@leopoletto">
    <meta name="twitter:creator" content="@leopoletto.com">
    <meta name="twitter:domain" content="leopoletto.com">
    <meta name="twitter:url" content="{{ str($page->getUrl())->beforeLast('/') }}">
    <meta name="twitter:title" content="{{ $page->title ?: $page->defaultTitle  }}">
    <meta name="twitter:text:title" content="{{ $page->title ?: $page->defaultTitle  }}">
    <meta name="twitter:description" content="{{ $page->description ?? $page->siteDescription }}">
    @if($page?->image)
        <meta name="twitter:image" content="{{$page->baseUrl . 'assets/images/og/' . $page->image}}">
        <meta name="twitter:alt" content="{{$page->baseUrl . 'assets/images/og/' . $page->image}}">
    @endif
    <link href="{{$page->baseUrl . 'blog/feed.atom' }}" type="application/atom+xml" rel="alternate"
          title="{{ $page->siteName }} Atom Feed">
    <link rel="apple-touch-icon" sizes="180x180" href="{{$page->baseUrl . 'favicon/apple-touch-icon.png' }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{$page->baseUrl . 'favicon/favicon-32x32.png' }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{$page->baseUrl . 'favicon/favicon-16x16.png' }}">
    <link rel="manifest" href="{{$page->baseUrl . 'favicon/site.webmanifest' }}">
    <link rel="mask-icon" href="{{$page->baseUrl . 'favicon/safari-pinned-tab.svg' }}" color="#0a0033">
    <link rel="home" href="{{ str($page->baseUrl)->beforeLast('/') }}">

    <link rel="stylesheet" href="{{$page->baseUrl . 'assets/fonts/jetbrains-mono.css' }}">
    <link rel="stylesheet" href="{{$page->baseUrl . 'assets/fonts/mozilla-headline.css' }}">
    <link rel="stylesheet" href="{{$page->baseUrl . 'assets/fonts/mozilla-text.css' }}">

    @viteRefresh()
    <link rel="stylesheet" href="{{ vite('source/_assets/css/main.css') }}">
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
<header x-data="{ light: true, wave: false }" class="py-10 px-5 flex items-center">
    <div class="container items-center justify-around mx-auto flex max-w-4xl flex-col gap-2 md:flex-row md:gap-10">
        <div class="hidden md:block border-2 relative group border-brand-secondary-500/40 rounded-3xl p-2 md:overflow-clip">
            <a href="{{ str($page->baseUrl)->beforeLast('/') }}"
               :class="{'motion-safe:animate-insight': light}"
               class="relative z-30 rounded-2xl self-baseline md:block md:w-fit md:overflow-clip">
                <img alt="A detailed headshot of a man with dark hair, light eyes, and stubble, wearing a black turtleneck and looking directly at the camera with a calm expression"
                     class="-scale-x-100 w-[200px] rounded-2xl md:w-[200px] md:min-w-[200px]"
                     src="{{ $page->baseUrl . 'assets/img/profile-q90-w240.webp' }}"/>
            </a>
            <span class="transition-all backdrop-blur-md backdrop-saturate-100 backdrop-xs backdrop-brightness-150 w-full aspect-square absolute left-0 top-0 z-20"></span>
            <span class="bg-[url('/assets/img/profile-q90-w240.webp')] bg-cover w-full aspect-square absolute left-0 top-0 z-10"></span>
        </div>
        <div class="w-fit min-h-max">
            <span>
                <a class="font-semibold text-brand-secondary-100 text-3xl font-serif"
                   href="{{ str($page->baseUrl)->beforeLast('/') }}">{{ $page->siteName  }}</a>
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
                                        href="{{ $page->baseUrl . 'blog/about'  }}"
                                        @mouseenter.stop="wave = true"
                                        @mouseleave.stop="wave = false"
                                        title="About Leonardo Poletto"
                                >About
                                </x-partials.menu-link>
                            </li>
                            <li>
                                <x-partials.menu-link href="{{ $page->baseUrl . 'tools-and-open-source'  }}"
                                          title="Learn more about tools"
                                          @mouseenter.stop="light = true"
                                          @mouseleave.stop="light = false">Open Source
                                </x-partials.menu-link>
                            </li>
                        </ul>
                    </x-slot:links>
                </x-partials.main-nav>
            </div>
        </div>
    </div>
</header>

<main class="container mx-auto w-full max-w-4xl px-5 flex-auto overflow-hidden">
    @yield('body')
</main>

<footer class="px-6 py-6 text-center border-t border-t-brand-secondary-400 md:px-0">
    <ul class="flex gap-5 justify-center items-center">
        <li class="text-base text-brand-secondary-100 after:content-['✦'] after:text-base after:ml-5">
            No tracking. No cookies. Just content.
        </li>
        <li class="text-base text-brand-secondary-100">
            Built with purpose. Maintained with integrity.
        </li>
    </ul>
</footer>
</body>
</html>
