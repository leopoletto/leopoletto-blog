<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => 'https://local.leopoletto.test/',
    'debug' => false,
    'production' => false,
    'language' => 'en-US',

    'general' => [
        'siteName' => 'Leopoletto',
        'title' => 'Leopoletto — Building, Learning, Sharing',
        'author' => 'Leonardo Poletto',
        'meta_description' => 'Software engineer and technical educator sharing insights from building tools, experiments, and lessons learned along the way.',
        'picture' => [
            'src' => 'assets/img/profile-resized-240.webp',
            'alt' => 'Portrait of Leonardo Poletto — Software Engineer and Technical Educator',
        ],
        'og' => [
            'logo' => 'favicon/android-chrome-512x512.png',
            'image' => 'assets/images/og/home.webp',
            'title' => 'Leopoletto — Building, Learning, Sharing',
            'description' => 'Follow Leonardo Poletto’s Open Lab: experiments, tools, and lessons from 14+ years of building dynamic systems.',
            'type' => 'website',
        ],
        'x' => [
            'card' => 'summary_large_image',
            'site' => '@leopoletto',
            'creator' => '@leopoletto',
            'title' => 'Leopoletto — Building, Learning, Sharing',
            'description' => 'Software engineer and technical educator sharing insights, tools, and experiments from 14+ years of building.',
            'image' => 'assets/images/og/home.webp',
        ],
        'manifest' => [
            'color' => '#0a0033',
            'file' => 'favicon/site.webmanifest',
        ],
        'atom' => 'blog/feed.atom',
    ],

    // Collections
    'collections' => [
        'posts' => [
            'author' => 'Leonardo Poletto',
            'sort' => '-date',
            'path' => 'blog/{filename}',
            'filter' => function ($item) {
                return $item;
            }
        ],
        'categories' => [
            'author' => 'Leonardo Poletto',
            'path' => 'categories/{filename}',
            'sort' => '-date',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return $post->categories && in_array($page->getFilename(), $post->categories, true);
                });
            },
        ],
    ],

    'build' => [
        'source' => 'source',
        'destination' => 'build_local',
    ],

    // Helpers
    'getDate' => function ($page) {
        return DateTime::createFromFormat('U', $page->date);
    },

    'getExcerpt' => function ($page, $length = 400) {
        if ($page->excerpt) {
            return $page->excerpt;
        }

        $content = preg_split('/<!-- more -->/m', $page->getContent(), 2);
        $cleaned = trim(
            strip_tags(
                preg_replace(['/<pre>[\w\W]*?<\/pre>/', '/<h\d>[\w\W]*?<\/h\d>/'], '', $content[0]),
                '<code>'
            )
        );

        if (count($content) > 1) {
            return $cleaned;
        }

        $truncated = substr($cleaned, 0, $length);

        if (substr_count($truncated, '<code>') > substr_count($truncated, '</code>')) {
            $truncated .= '</code>';
        }

        return strlen($cleaned) > $length
            ? preg_replace('/\s+?(\S+)?$/', '', $truncated) . '...'
            : $cleaned;
    },

    'isActive' => function ($page, $path) {
        return Str::endsWith(trimPath($page->getPath()), trimPath($path));
    },

    'getReadingTime' => function ($page) {
        $wordsPerMinutes = 130;
        $readingTime = ceil(str_word_count($page->getContent()) / $wordsPerMinutes);
        return sprintf('%d %s %s', $readingTime, Str::plural('minute', $readingTime), 'read');
    },

    'isFeatured' => function ($page) {
        return (bool) $page->featured;
    },

    // Centralized Metadata Helper
    'head' => function ($page, $key) {
        // Dot-notation getter with default
        $get = function ($array, $path, $default = null) use (&$get) {
            if (!is_array($array)) {
                $array = $array->toArray();
            }
            $segments = explode('.', $path);
            foreach ($segments as $segment) {
                if (!array_key_exists($segment, $array)) {
                    return $default;
                }
                $array = $array[$segment];
            }
            return $array ?? $default;
        };

        // Full map with fallbacks
        $map = [
            // Basic SEO
            'title'       => [$page->title ?? null, $get($page->general, 'title')],
            'description' => [$page->description ?? null, $page->summary ?? null, $get($page->general, 'meta_description')],
            'author'      => [$get($page->general, 'author', 'Leonardo Poletto')],
            'language'    => [$page->language ?? $page->siteLanguage ?? 'en-US'],

            // Open Graph
            'og:title'       => [$page->og_title ?? null, $page->title ?? null, $get($page->general, 'og.title')],
            'og:description' => [$page->og_description ?? null, $page->description ?? null, $get($page->general, 'og.description')],
            'og:image'       => [
                $page->og_image ? $page->baseUrl . $page->og_image : null,
                $page->image ? $page->baseUrl . $page->image : null,
                $page->baseUrl . $get($page->general, 'og.image'),
            ],
            'og:logo'        => [$page->baseUrl . $get($page->general, 'og.logo')],
            'og:type'        => [$page->og_type ?? $get($page->general, 'og.type', 'website')],

            // Twitter / X
            'x:title'       => [$page->x_title ?? null, $page->og_title ?? null, $page->title ?? null, $get($page->general, 'x.title')],
            'x:description' => [$page->x_description ?? null, $page->og_description ?? null, $page->description ?? null, $get($page->general, 'x.description')],
            'x:image'       => [
                $page->x_image ? $page->baseUrl . $page->x_image : null,
                $page->og_image ? $page->baseUrl . $page->og_image : null,
                $page->baseUrl . $get($page->general, 'x.image'),
            ],
            'x:card'    => [$get($page->general, 'x.card', 'summary_large_image')],
            'x:site'    => [$get($page->general, 'x.site', '@leopoletto')],
            'x:creator' => [$get($page->general, 'x.creator', '@leopoletto')],

            // Manifest & Favicon
            'manifest:file'  => [$page->baseUrl . $get($page->general, 'manifest.file')],
            'manifest:color' => [$get($page->general, 'manifest.color')],
            'favicon:apple'  => [$page->baseUrl . 'favicon/apple-touch-icon.png'],
            'favicon:32'     => [$page->baseUrl . 'favicon/favicon-32x32.png'],
            'favicon:16'     => [$page->baseUrl . 'favicon/favicon-16x16.png'],
            'favicon:mask'   => [$page->baseUrl . 'favicon/safari-pinned-tab.svg'],

            // Atom Feed
            'feed:atom'      => [$page->baseUrl . $get($page->general, 'atom')],
        ];

        // Check map first
        if (isset($map[$key])) {
            foreach ($map[$key] as $value) {
                if (!empty($value)) {
                    return $value;
                }
            }
        }

        // Fallback: allow direct access to general keys via dot notation
        $generalValue = $get($page->general, $key);
        return !empty($generalValue) ? $generalValue : '';
    },
];