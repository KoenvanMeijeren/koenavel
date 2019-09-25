<?php
declare(strict_types=1);


namespace App\services\core;


use App\services\validate\Validate;
use Exception;

final class Router
{
    /**
     * All the routes, stored based on the request type -> rights -> url.
     * Rights:
     * 1 = Student
     * 2 = Teacher
     * 3 = read
     * 4 = read and write
     * 5 = read, write and update
     * 6 = read, write, update and destroy
     * 7 = account management.
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
     * @var int|string
     */
    private static $wildcard;

    /**
     * Load the routes.
     *
     * @param string $file the file location of the routes
     *
     * @return Router
     *
     * @throws Exception
     */
    public static function load(string $file)
    {
        loadFile(ROUTES_PATH.'/'.$file);

        return new static();
    }

    /**
     * Define the get routes.
     *
     * @param string $route      the get route
     * @param string $controller the controller to execute when the route is called
     * @param int    $rights     the rights of the user to be able to visit routes based on the given rights
     */
    public static function get(string $route, string $controller, int $rights = 0)
    {
        self::$routes['GET'][$rights][$route] = $controller;
    }

    /**
     * Define the post routes.
     *
     * @param string $route      the post route
     * @param string $controller the controller to execute when the route is called
     * @param int    $rights     the rights of the user to be able to visit routes based on the given rights
     */
    public static function post(string $route, string $controller, int $rights = 0)
    {
        self::$routes['POST'][$rights][$route] = $controller;
    }

    /**
     * Return the current used wildcard.
     *
     * @return int|string
     */
    public static function getWildcard()
    {
        return self::$wildcard;
    }

    /**
     * Direct an url to a controller.
     *
     * @param string $url         the current url to search for the corresponding route in the routes
     * @param string $requestType the request type
     * @param int    $rights      the rights of the user
     *
     * @return View
     *
     * @throws Exception
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

        throw new Exception('No route defined for this url');
    }

    /**
     * Execute the route and call the controller.
     *
     * @param string $url the current url to search for the corresponding route in the routes
     *
     * @return View
     *
     * @throws Exception
     */
    private function executeRoute(string $url)
    {
        $route = explode('@', self::$availableRoutes[$url]);
        $controller = 'App\controllers\\'.$route[0] ?? '';
        $controller = new $controller();
        $methodName = $route[1] ?? 'index';

        Validate::var($controller)->isObject();
        Validate::var($controller)->methodExists($methodName);

        return $controller->{$methodName}();
    }

    /**
     * Set the available routes based on the current rights of the user.
     *
     * @param string $requestType the request type
     * @param int    $rights      the current rights of the user of the app
     */
    private function setAvailableRoutes(string $requestType, int $rights)
    {
        for ($i = 0; $i <= $rights; ++$i) {
            if (isset(self::$routes[$requestType][$i])) {
                self::$availableRoutes = array_merge(self::$availableRoutes, self::$routes[$requestType][$i]);
            }
        }
    }

    /**
     * Replace the wildcards in the given routes.
     * Store the current used wildcard.
     *
     * @param string $url the current url
     */
    private function replaceWildcards(string $url)
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
     * @param array  $routeExploded the route exploded in parts divided by slashes
     * @param array  $urlExploded   the url exploded in parts divided by slashes
     * @param string $route         the route to search for a replacement
     */
    private function updateRoute(array $routeExploded, array $urlExploded, string $route)
    {
        // if route and url exploded are not the same size, return void.
        if (count($urlExploded) !== count($routeExploded)) {
            return;
        }

        // loop through the route exploded array and if there is a match and
        // if it contains {a-zA-Z} replace it with the same value on the
        // same position from the url exploded array
        foreach ($routeExploded as $key => $routePart) {
            if (isset($urlExploded[$key]) && preg_match('/{[a-zA-Z]+}/', $routePart)) {
                $newRoute = preg_replace('/{[a-zA-Z]+}/', $urlExploded[$key], $route);
                self::$wildcard = $urlExploded[$key];
                self::$availableRoutes = array_replace_keys(self::$availableRoutes, [$route => $newRoute]);

                return;
            }
        }
    }
}
