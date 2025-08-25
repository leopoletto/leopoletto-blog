<?php

namespace App\Listeners;

use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use TightenCo\Jigsaw\Jigsaw;

class GenerateOpenGraphImage
{
    public function handle(Jigsaw $jigsaw)
    {
        collect($jigsaw->getCollection('posts')->each(function ($page) use ($jigsaw) {
            $path = explode('/', $page->getPath());
            $slug = end($path);
            $command = [
                new ExecutableFinder()->find('node', 'node', [
                    '/usr/local/bin',
                    '/opt/homebrew/bin',
                ]),
                'runner.js',
                $page->title,
                $slug
            ];
            $process = new Process($command, cwd: $jigsaw->getSourcePath() . '/../screenshot');

            $process->run();
        })->values());
    }
}