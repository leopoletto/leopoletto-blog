<?php

namespace App\Listeners;

use Illuminate\Support\Collection;
use TightenCo\Jigsaw\Jigsaw;

class GenerateIndex
{
    public function handle(Jigsaw $jigsaw)
    {
        $isProduction = $jigsaw->getEnvironment() === 'production';

        $posts = collect($jigsaw->getCollection('posts'));

        $publishedPosts = $posts->when($isProduction, function (Collection $posts) {
            return $posts->filter(fn($post) => $post->published);
        });

        $displayingPosts = $publishedPosts ?: $posts;

        $data = $displayingPosts->map(function ($page) use ($jigsaw) {
            return [
                'title' => $page->title,
                'categories' => $page->categories,
                'link' => rightTrimPath($jigsaw->getConfig('baseUrl')).$page->getPath(),
                'snippet' => $page->getExcerpt(),
            ];
        });

        file_put_contents($jigsaw->getDestinationPath().'/index.json', json_encode($data->values()));
    }
}
