<?php
declare(strict_types=1);


namespace App\services\core;

use App\services\session\Session;
use App\services\translation\Builder as TranslationBuilder;
use Exception;

final class App
{
    /**
     * The location of the routes file.
     *
     * @var string
     */
    private $routesLocation;

    /**
     * Construct the app.
     *
     * Set the env based on the current environment (development - production)
     * Set a default date timezone
     * Start the session and set some basic security protection.
     * Set the language and load all the corresponding translations.
     * Set the user for the application.
     *
     * @param string $routesLocation the routes file location
     *
     * @throws Exception
     */
    public function __construct(string $routesLocation = 'web.php')
    {
        $this->routesLocation = $routesLocation;
        date_default_timezone_set('Europe/Amsterdam');

        new Env();
        new Session(1 * 1 * 60 * 60);
        new TranslationBuilder();
    }

    /**
     * Run the app.
     *
     * @throws Exception
     */
    public function run(): void
    {
        Router::load($this->routesLocation)
            ->direct(URI::getUrl(), URI::method(), 0);

        Log::appRequest();
    }
}
