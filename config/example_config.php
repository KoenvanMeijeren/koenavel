<?php

declare(strict_types=1);

use App\services\Core\Config;
use App\Services\Translation\Builder as Translation;

// APP NAME
Config::set('appName', '');

// SET LOCALE DATE
setlocale(LC_TIME, Translation::DUTCH_TIME);
date_default_timezone_set('Europe/Amsterdam');

// DATABASE
Config::set('databaseName', '');
Config::set('databaseUsername', '');
Config::set('databasePassword', '');
Config::set('databaseServer', 'mysql:host=localhost');
Config::set('databasePort', '3306');
Config::set('databaseCharset', 'utf8mb4');
Config::set('databaseOptions', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

// MAXIMUM NUMBER OF LOG IN ATTEMPTS
Config::set('loginAttempts', 3);

// GOOGLE RECAPTCHA KEYS
Config::set('recaptcha_public_key', '');
Config::set('recaptcha_secret_key', '');

// TINY MCE KEY
Config::set('tinyMceKey', '');

// ENCRYPTION TOKEN
Config::set('encryptionToken', '');

// SECRET KEY
Config::set('secretKey', '');

// APP IS PREPARED
Config::setPreparedState();
