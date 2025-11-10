<?php

namespace App\Service;

use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\DependencyInjection\Attribute\Autowire;

final class FileManager
{
    private string $projectDir;
    private Filesystem $filesystem;

    public function __construct(#[Autowire(param: 'kernel.project_dir')] string $projectDir)
    {
        $this->projectDir = rtrim($projectDir, '/');
        $this->filesystem = new Filesystem();
    }

    /**
     * Save content under var/ directory and return absolute path.
     */
    public function save(string $relativeDirectory, string $filename, string $content): string
    {
        $baseDir = $this->projectDir . '/var/' . ltrim($relativeDirectory, '/');
        if (!$this->filesystem->exists($baseDir)) {
            $this->filesystem->mkdir($baseDir, 0775);
        }

        $path = $baseDir . '/' . $filename;
        $this->filesystem->dumpFile($path, $content);

        return $path;
    }
}


