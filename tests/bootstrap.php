<?php
declare(strict_types=1);


require_once __DIR__ . '/../vendor/autoload.php';

$dotEnv = \Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotEnv->load();

error_reporting(E_ALL | E_STRICT);

