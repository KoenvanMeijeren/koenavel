<?php
declare(strict_types=1);

use App\services\Core\App;

require_once __DIR__ . '/config/const.php';
require_once APP_PATH . '/Functions/autoload.php';
require_once VENDOR_PATH . '/autoload.php';

$app = new App();
$app->run();
