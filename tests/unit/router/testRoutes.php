<?php
declare(strict_types=1);

use App\services\core\Router;

/**
 * Regular routes
 */
Router::get('', 'TestController@index', 0);
Router::get('test', 'TestController@index', 0);
Router::get('testRights', 'TestController@rightOne', 1);
Router::get('testRights', 'TestController@rightTwo', 2);
Router::get('wildcard/{slug}', 'TestController@wildcard', 0);
Router::get('test/wildcard/too/short/{slug}', 'TestController@wildcard', 0);

/**
 * Route not found.
 */
Router::get('fourNullFour', 'TestController@notFound', 0);
