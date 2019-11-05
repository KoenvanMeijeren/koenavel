<?php
declare(strict_types=1);

use App\Src\Core\App;

require_once __DIR__ . '/config/const.php';
require_once APP_PATH . '/Functions/autoload.php';
require_once VENDOR_PATH . '/autoload.php';

$app = new App();
$app->run();

// todo rewrite sensitive config data into .env files
// todo add random generated session id
// todo make local settings work
// todo: Actually flash data into the session -> todo store it and after using it, destroy the data
