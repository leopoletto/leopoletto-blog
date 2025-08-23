<?php

return [
    'production' => true,
    'baseUrl' => 'https://leopoletto.dev/',
    'collections' => [
        'posts' => [
            'getCategories'=> function ($page) {
                return isset($page->categories) && is_array($page->categories) ? $page->categories : [];
            },
            'author' => 'Leonardo Poletto', // Default author, if not provided in a post
            'sort' => '-date',
            'path' => 'blog/{filename}',
            'filter' => function ($item) {
                return $item->published;
            }
        ],
        'categories' => [
            'path' => 'categories/{filename}',
            'posts' => function ($page, $allPosts) {
                return $allPosts->filter(function ($post) use ($page) {
                    return $post->categories && in_array($page->getFilename(), $post->categories, true);
                });
            },
        ],
    ]
];
