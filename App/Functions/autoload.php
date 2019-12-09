<?php

declare(strict_types=1);

use App\Src\Validate\Validate;

$filenames = [
    'default',
    'csv',
    'load_items',
];

foreach ($filenames as $filename) {
    $filename = APP_PATH . '/functions/' . $filename . '.php';

    Validate::var($filename)->fileExists();

    include_once $filename;
}
