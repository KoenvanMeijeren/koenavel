<?php
declare(strict_types=1);


namespace App\Src\Core;

use App\Src\Exceptions\Basic\InvalidRouteAndUriException;
use App\Src\Exceptions\File\FileNotFoundException;
use App\Src\Exceptions\Object\InvalidMethodCalledException;
use App\Src\Exceptions\Object\InvalidObjectException;
use App\Src\Validate\Validate;
use App\Src\View\View;

final class Router
{
    /**
     * All the routes, stored based on the request type -> rights -> url.
     * Rights:
     * 1 = Student
     * 2 = Teacher
     * 3 = Maintainer
     * 4 = Super maintainer
     *
     * @var array
     */
    private static $routes = [
        'GET' => [],
        'POST' => [],
    ];

    /**
     * All the available routes based on the current rights of the user.
     *
     * @var array
     */
    private static $availableRoutes = [];

    /**
     * The current used wildcard.
     *
     * @var string
     */
    private static $wildcard;

    /**
     * Load the routes.
     *
     * @param string $file          the file location of the routes
     * @param string $directoryPath the directory location of the routes
     *
     * @return Router
     *
     * @throws FileNotFoundException
     */
    public static function load(
        string $file = 'web.php',
        string $directoryPath = ROUTES_PATH . '/'
    ): Router {
        self::resetRoutes();
        loadFile($directoryPath.$file);

        return new Router();
    }

    /**
     * Define the get routes.
     *
     * @param string $route      the get route
     * @param string $controller the controller to execute when
     *                           the route is called
     * @param string $method     a specific method from the controller
     * @param int    $rights     the rights of the user to be able to
     *                           visit routes based on the given rights
     */
    public static function get(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = 0
    ): void {
        self::$routes['GET'][$rights][$route] = [$controller, $method];
    }

    /**
     * Define the post routes.
     *
     * @param string $route      the post route
     * @param string $controller the controller to execute when
     *                           the route is called
     * @param string $method     a specific method from the controller
     * @param int    $rights     the rights of the user to be able to
     *                           visit routes based on the given rights
     */
    public static function post(
        string $route,
        string $controller,
        string $method = 'index',
        int $rights = 0
    ): void {
        self::$routes['POST'][$rights][$route] = [$controller, $method];
    }

    /**
     * Return the current used wildcard.
     *
     * @return string
     */
    public static function getWildcard()
    {
        return self::$wildcard;
    }

    /**
     * Direct an url to a controller.
     *
     * @param string $url         the current url to search for the
     *                            corresponding route in the routes
     * @param string $requestType the request type
     * @param int    $rights      the rights of the user
     *
     * @return View|string
     *
     * @throws InvalidObjectException
     * @throws InvalidMethodCalledException
     * @throws InvalidRouteAndUriException
     */
    public function direct(string $url, string $requestType, int $rights)
    {
        $this->setAvailableRoutes($requestType, $rights);
        $this->replaceWildcards($url);
        if (array_key_exists($url, self::$availableRoutes)) {
            return $this->executeRoute($url);
        }

        $this->setAvailableRoutes('GET', $rights);
        if (array_key_exists('fourNullFour', self::$availableRoutes)) {
            return $this->executeRoute('fourNullFour');
        }

        throw new InvalidRouteAndUriException(
            'No route defined for this request'
        );
    }

    /**
     * Execute the route and call the controller.
     *
     * @param string $url the current url to search for the
     *                    corresponding route in the routes
     *
     * @return View|string
     *
     * @throws InvalidObjectException
     * @throws InvalidMethodCalledException
     */
    private function executeRoute(string $url)
    {
        $route = self::$availableRoutes[$url];
        $controller = new $route[0]();
        $methodName = $route[1];

        Validate::var($controller)->isObject();
        Validate::var($controller)->methodExists($methodName);

        return $controller->{$methodName}();
    }

    /**
     * Set the available routes based on the current rights of the user.
     *
     * @param string $requestType the request type to access the page
     * @param int    $rights      the rights of the user of the app
     */
    private function setAvailableRoutes(string $requestType, int $rights): void
    {
        self::$availableRoutes = [];

        for ($i = 0; $i <= $rights; ++$i) {
            if (isset(self::$routes[$requestType][$i])) {
                // @codeCoverageIgnoreStart
                self::$availableRoutes = array_merge(
                    self::$availableRoutes,
                    self::$routes[$requestType][$i]
                );
                // @codeCoverageIgnoreEnd
            }
        }
    }

    /**
     * Replace the wildcards in the given routes.
     * Store the current used wildcard.
     *
     * @param string $url the current url
     */
    private function replaceWildcards(string $url): void
    {
        foreach (array_keys(self::$availableRoutes) as $route) {
            $routeExploded = explode('/', $route);
            $urlExploded = explode('/', $url);
            if (preg_match('/{[a-zA-Z]+}/', $route)) {
                $this->updateRoute($routeExploded, $urlExploded, $route);
            }
        }
    }

    /**
     * Update a specific route. Replace the slug for the matching value from the url.
     *
     * @param string[] $routeExploded the route exploded in parts divided by slashes
     * @param string[] $urlExploded   the url exploded in parts divided by slashes
     * @param string   $route         the route to search for a replacement
     */
    private function updateRoute(
        array $routeExploded,
        array $urlExploded,
        string $route
    ): void {
        // if route and url exploded are not the same size, return void.
        if (count($urlExploded) !== count($routeExploded)) {
            return;
        }

        // loop through the route exploded array and if there is a match and
        // if it contains {a-zA-Z} replace it with the same value on the
        // same position from the url exploded array
        foreach ($routeExploded as $key => $routePart) {
            if (isset($urlExploded[$key]) &&
                preg_match('/{[a-zA-Z]+}/', $routePart)
            ) {
                $newRoute = preg_replace(
                    '/{[a-zA-Z]+}/',
                    $urlExploded[$key],
                    $route
                );
                self::$wildcard = $urlExploded[$key];
                // @codeCoverageIgnoreStart
                self::$availableRoutes = array_replace_keys(
                    self::$availableRoutes,
                    [$route => $newRoute]
                );
                // @codeCoverageIgnoreEnd

                break;
            }
        }

        return;
    }

    /**
     * Reset all the current stored routes.
     */
    private static function resetRoutes(): void
    {
        self::$routes = [
            'GET' => [],
            'POST' => [],
        ];
        self::$availableRoutes = [];
    }
}
