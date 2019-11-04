<?php
declare(strict_types=1);


namespace App\Src\View;

use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

final class View
{
    /**
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     */
    public function __construct(string $name, array $content = [])
    {
        $filesystemLoader = new FilesystemLoader(
            RESOURCES_PATH.'/views/%name%'
        );

        $templating = new PhpEngine(
            new TemplateNameParser(),
            $filesystemLoader
        );

        echo $templating->render(
            'layout.view.php',
            [
                'title' => 'test',
                'content' => $this->renderContent($name, $content)
            ]
        );
    }

    /**
     * Render a partial view into the layout view.
     *
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     *
     * @return string
     */
    private function renderContent(string $name, array $content = []): string
    {
        ob_start();

        loadFile(RESOURCES_PATH."/views/{$name}.view.php", $content);

        $content = ob_get_clean();

        return (string) $content;
    }
}
