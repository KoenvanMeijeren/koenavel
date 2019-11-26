<?php
declare(strict_types=1);


namespace App\Src\File;

use Symfony\Component\Filesystem\Filesystem;

final class File
{
    /**
     * @var Filesystem
     */
    private $system;

    /**
     * @var string
     */
    private $directory;

    /**
     * @var string
     */
    private $file;

    /**
     * @var string
     */
    private $path;

    public function __construct(string $directory, string $file)
    {
        $this->system = new FileSystem();

        $this->directory = $directory;
        $this->file = $file;

        $this->system->mkdir($directory);
        $this->makePath();
    }

    /**
     * Check if the given path already has stored content.
     *
     * @return bool
     */
    public function isEmpty(): bool
    {
        $link = $this->system->readlink($this->path, true);
        $content = file_get_contents($link);

        return $content === false || $content === '';
    }

    /**
     * Put content in the file.
     *
     * @param string $content
     */
    public function putContent(string $content): void
    {
        $this->system->dumpFile($this->path, $content);
    }

    /**
     * Get the content of the file.
     *
     * @param string[] $vars
     *
     * @return string
     */
    public function get(array $vars = []): string
    {
        if ($this->system->readlink($this->path, true) === null) {
            return '';
        }

        ob_start();

        includeFile(
            $this->system->readlink($this->path, true),
            $vars
        );

        return (string) ob_get_clean();
    }

    /**
     * Bind the directory and file path.
     */
    private function makePath(): void
    {
        $this->path = $this->directory . '/' . $this->file;
    }
}
