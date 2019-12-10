<?php
declare(strict_types=1);


namespace App\Src\View;


use Symfony\Component\Templating\Loader\FilesystemLoader;
use Symfony\Component\Templating\PhpEngine;
use Symfony\Component\Templating\TemplateNameParser;

abstract class BaseView
{
    /**
     * @param string    $layout    the layout of the whole view.
     * @param string    $name      the name of the partial view.
     * @param mixed[]   $content   the content of the partial view.
     */
    protected function __construct(string $layout, string $name, array $content)
    {
        $filesystemLoader = new FilesystemLoader(
            RESOURCES_PATH.'/partials/%name%'
        );

        $templating = new PhpEngine(
            new TemplateNameParser(),
            $filesystemLoader
        );

        echo $templating->render($layout, [
            'content' => $this->renderContent($name, $content),
            'data' => $content
        ]);
    }

    /**
     * Render a partial view into the layout view.
     *
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     *
     * @return string
     */
    abstract protected function renderContent(string $name, array $content = []): string;
}
