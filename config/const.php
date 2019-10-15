<?php

declare(strict_types=1);

// Base path
define('BASE_PATH', str_replace('\\', '/', __DIR__));

// Default paths
define('START_PATH', realpath(__DIR__.'/../'));
define('APP_PATH', realpath(__DIR__ . '/../App'));
define('CONFIG_PATH', realpath(__DIR__.'/../config'));
define('RESOURCES_PATH', realpath(__DIR__.'/../resources'));
define('ROUTES_PATH', realpath(__DIR__.'/../routes'));
define('STORAGE_PATH', realpath(__DIR__.'/../storage'));
define('TEST_PATH', realpath(__DIR__.'/../tests'));
define('VENDOR_PATH', realpath(__DIR__.'/../vendor'));

// Asset paths
define('ASSET_PATH', '');
