<?php
declare(strict_types=1);


namespace App\Services\Core;

use App\Contract\Services\Core\AppContract;
use App\Services\Session\Builder as SessionBuilder;
use App\Services\Translation\Builder as TranslationBuilder;
use Exception;

final class App implements AppContract
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

        $env = new Env();
        $env->setEnv();
        $env->setErrorHandling();

        // todo: add random generated session id
        $sessionBuilder = new SessionBuilder();
        $sessionBuilder->startSession();
        $sessionBuilder->setSessionSecurity();

        $translationBuilder = new TranslationBuilder();
        $translationBuilder->setLanguageID();
        $translationBuilder->loadTranslations();
    }

    /**
     * Run the app.
     *
     * @throws Exception
     */
    public function run(): void
    {
        $uri = new URI();
        $log = new Log();
        $router = new Router();

        $router->load($this->routesLocation)->direct(
            $uri->getUrl(),
            $uri->getMethod(),
            0
        );

        $log->appRequest(
            '',
            'successful',
            $uri->getUrl(),
            $uri->getMethod()
        );
    }
}
