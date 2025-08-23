<?php

use Illuminate\Support\Str;

return [
    'baseUrl' => 'https://local.leopoletto.test/',
    'production' => false,
    'siteName' => 'Leonardo Poletto',
    'siteDescription' => 'Professional portrait of Leonardo Poletto, a confident, well-groomed man with short dark hair, wearing a dark blue shirt, against a modern, neutral-toned background',
    'siteAuthor' => 'Leonardo Poletto',
    'image' => 'leopoletto.webp',
    'defaultTitle' => 'Leonardo Poletto - Technology Blog Writer specializing in Laravel',
    'type' => 'website',
    // collections
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

    // helpers
    'getDate' => function ($page) {
        return Datetime::createFromFormat('U', $page->date);
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
        return  sprintf('%d %s %s', $readingTime, Str::plural('minute', $readingTime), ' read');
    },
    'isFeatured' => function($page) {
        return (bool) $page->featured;
    }
];
