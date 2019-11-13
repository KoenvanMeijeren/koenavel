<?php

use App\Src\Core\Env;

?>
<div class="mb-3">
    <h2 class="h4">
        Applicatie status:
        <span class="font-weight-bold"><?= $env ?? Env::DEVELOPMENT ?></span>
    </h2>
    <hr>

    <h2 class="h4">
        Sessie informatie
    </h2>
    <hr>

    <?= $sessionSettings ?? 'Geen sessie instellingen gevonden' ?>
    <hr>

    <?= $sessionInformation ?? 'Geen sessie informatie gevonden' ?>
    <hr>

    <h2 class="h4 scrollbox-horizontal">
        Cookie informatie
    </h2>

    <?= $cookieInformation ?? 'Geen cookie informatie gevonden' ?>
    <hr>

    <h2 class="h4">
        Log informatie
    </h2>

    <div class="scrollbox-vertical">
        <?= $logInformation ?? 'Geen log informatie gevonden' ?>
    </div>
    <hr>
</div>
