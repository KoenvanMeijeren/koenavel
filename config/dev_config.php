<?php

declare(strict_types=1);

return [
    // App name
    'appName' => 'Koenavel',

    // App url
    'appUri' => 'http://localhost:8002',

    // Database
    'databaseOptions' => [
        PDO::ATTR_EMULATE_PREPARES, false,
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ],

    // Login attempts
    'loginAttempts' => 3,

    // Google Recaptcha keys
    'recaptcha_public_key' => '6LcuaMYUAAAAAEWEAHXJImzq3oBnuuEq1_fPBs6S',
    'recaptcha_secret_key' => '6LcuaMYUAAAAAAFi6dLnSlkQzWm1mAZ3P1kTgjjk',

    // Tiny MCE key
    'tinyMceKey' => 'amyz5vlo9d4hlbop0b78rh9earl2dxn0ljxerv4vuyfcqawj',

    // Encryption token and key
    'encryptionToken' => 'def00000bf6a79439be74b32d34b4c00dcb528a02f654b34472d1ca02383fc0284804eaa8404d6d0af3c41f7651d7f5d424af236f0daee2eea3704d00af9b1f68b31317b',
    'secretKey' => 'ed0e050350bf9a35a201f4216d097a75f40eed9d18194ab3e4c9083a2d5496d909030c23ecf09bf3f58408a37639ea5186fb73e9fc101ac2e1b91746d704af5bfcbe456bf2bc74e12c2d4cf51498593f601ec034e9ad0733587e839b55089eb64137430f126dc8878a66470f7db3fe24f724e7ad3f10ecf745d7fd3c741d834e2010ae6b0858f21f0f4da6832eb6b26d0c403e3a634116528173f794158482d271f27e09e9c0a9160aa8361d49547e827941325a89a9c0903bcb01c39acaec6cb86b24a6a5a9b523',

    // Inspector token
    'inspector_token' => 'f2c07f0ddc347cff73a9a03d981037f4',
];
