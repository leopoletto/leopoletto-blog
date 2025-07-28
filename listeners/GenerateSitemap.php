<?php

namespace App\Listeners;

use Illuminate\Support\Collection;
use samdark\sitemap\Sitemap;
use TightenCo\Jigsaw\Jigsaw;
use Illuminate\Support\Str;
use TightenCo\Jigsaw\PageVariable;

class GenerateSitemap
{
    protected array $exclude = [
        '/assets/*',
        '*/favicon.ico',
        '*/404*',
        '/favicon/*'
    ];

    public function handle(Jigsaw $jigsaw)
    {
        $baseUrl = $jigsaw->getConfig('baseUrl');

        if (!$baseUrl) {
            echo("\nTo generate a sitemap.xml file, please specify a 'baseUrl' in config.php.\n\n");

            return;
        }

        $env = $jigsaw->getEnvironment();
        $posts = $jigsaw->getCollection('posts');

        $sitemap = new Sitemap($jigsaw->getDestinationPath() . '/sitemap.xml');

        collect($jigsaw->getOutputPaths())
            ->reject(fn ($path) => $this->isExcluded($path, $posts, $env))
            ->each(function ($path) use ($baseUrl, $sitemap) {
                $url = rightTrimPath($baseUrl) . $path;

                if (!Str::of($path)->contains('.')) {
                    $sitemap->addItem($url, time(), Sitemap::DAILY);
                }
            });

        $sitemap->write();
    }

    public function isExcluded($path, Collection $collections, string $env = 'local'): bool
    {
        if(Str::is($this->exclude, $path)){
            return true;
        }

        /** @var PageVariable $posts */
        if($posts = $collections->whereIn('type', ['article', 'page'])){
            if($post = $posts->get("/{$path}")){
                return $env === 'production' && !$post->published;
            }
        }

        return false;
    }
}
