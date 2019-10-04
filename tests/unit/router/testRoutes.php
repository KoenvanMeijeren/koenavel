<?php
declare(strict_types=1);

use App\services\core\Router;

require_once __DIR__ . '/TestController.php';

/**
 * Regular routes
 */
Router::get('', TestController::class, 'index', 0);
Router::get('test', TestController::class, 'index', 0);
Router::get('testRights', TestController::class, 'rightOne', 1);
Router::get('testRights', TestController::class, 'rightTwo', 2);
Router::get('wildcard/{slug}', TestController::class, 'wildcard', 0);
Router::get('test/wildcard/too/short/{slug}', TestController::class, 'wildcard', 0);

/**
 * Route not found.
 */
Router::get('fourNullFour', TestController::class, 'notFound', 0);
