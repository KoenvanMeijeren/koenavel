<?php
declare(strict_types=1);

use App\services\core\Router;

Router::get('', 'TestController@index', 0);
Router::get('test', 'TestController@index', 1);
Router::get('test/{slug}', 'TestController@index', 1);
