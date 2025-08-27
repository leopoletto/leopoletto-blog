<?php

namespace App\Listeners;

use Symfony\Component\Process\ExecutableFinder;
use Symfony\Component\Process\Process;
use TightenCo\Jigsaw\Jigsaw;

class GenerateOpenGraphImage
{
    public function handle(Jigsaw $jigsaw)
    {
        $isProduction = $jigsaw->getEnvironment() === 'production' ? 1  : 0;

        $this->run($isProduction, 'Blog', 'home', $jigsaw->getSourcePath(), 150);
        dump('home');
        $this->run($isProduction, 'Open Lab', 'open-lab', $jigsaw->getSourcePath(), 150);
        dump('open-lab');

        collect($jigsaw->getCollection('posts')->each(function ($page) use ($jigsaw, $isProduction) {
            if($page->og_image){
                $fileInfo = pathinfo($page->og_image);
                dump($fileInfo['filename']);
                $this->run($isProduction, $page->title, $fileInfo['filename'], $jigsaw->getSourcePath());
            }
        })->values());
    }

    private function run($production, $title, $filename, $sourcePath, $fontSize = null)
    {
        $command = [
            new ExecutableFinder()->find('node', 'node', [
                '/usr/local/bin',
                '/opt/homebrew/bin',
            ]),
            'runner.js',
            $production,
            $title,
            $filename,
            $fontSize
        ];
        $process = new Process($command, cwd: $sourcePath.'/../screenshot');
        $process->run();
    }
}