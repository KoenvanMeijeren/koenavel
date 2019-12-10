<?php
declare(strict_types=1);


namespace App\Src\View;

use App\Src\Core\URI;

final class View extends BaseView
{
    /**
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     */
    public function __construct(string $name, array $content = [])
    {
        $layout = 'layout.view.php';
        if (strpos(URI::getUrl(), 'admin') !== false) {
            $layout = 'admin.layout.view.php';
        }

        parent::__construct($layout, $name, $content);
    }

    /**
     * Render a partial view into the layout view.
     *
     * @param string    $name      the name of the partial view
     * @param mixed[]   $content   the content of the partial view
     *
     * @return string
     */
    protected function renderContent(string $name, array $content = []): string
    {
        ob_start();

        includeFile(RESOURCES_PATH."/partials/{$name}.view.php", $content);

        return (string) ob_get_clean();
    }
}
