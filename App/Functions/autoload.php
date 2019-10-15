<?php

declare(strict_types=1);

$filenames = [
    'default',
    'date_time',
    'csv',
    'load_items',
];

foreach ($filenames as $filename) {
    $filename = APP_PATH.'/functions/'.$filename.'.php';

    if (file_exists($filename)) {
        include_once $filename;
    }
}
