<?php

namespace App\Listeners;

use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use TightenCo\Jigsaw\Jigsaw;

class GenerateOpenGraphImage
{
    public function handle(Jigsaw $jigsaw)
    {
        $this->run('Blog', 'home.webp', $jigsaw->getSourcePath(), 150);
        $this->run('Open Lab', 'open-lab.webp', $jigsaw->getSourcePath(), 150);

        collect($jigsaw->getCollection('posts')->each(function ($page) use ($jigsaw) {
            if(!$page->og_image){
                $fileInfo = pathinfo($page->og_image);
                $this->run($page->title, $fileInfo['filename'], $jigsaw->getSourcePath());
            }
        })->values());
    }

    private function run($title, $filename, $sourcePath, $fontSize = null)
    {
        $command = [
            new ExecutableFinder()->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            'runner.js',
            $title,
            $filename,
            $fontSize
        ];
        $process = new Process($command, cwd: $sourcePath.'/../screenshot');
        $process->run();
    }
}