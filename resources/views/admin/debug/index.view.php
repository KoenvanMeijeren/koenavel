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

    <div class="row">
        <div class="col-sm-4 scrollbox-vertical">
            <div class="list-group overflow-hidden" id="list-tab" role="tablist">
                <?php $active = 'active';
                foreach (($logs ?? []) as $key => $log) : ?>
                    <a class="list-group-item list-group-item-action <?= $active ?>"
                       id="list-<?= $key ?>-list" data-toggle="list"
                       href="#list-<?= $key ?>" role="tab"
                       aria-controls="<?= $key ?>">
                        <?= $log['title'] ?? 'undefined' ?>
                    </a>
                    <?php $active = '';
                endforeach; ?>
            </div>
        </div>
        <div class="col-sm-8 scrollbox-vertical">
            <div class="tab-content" id="nav-tabContent">
                <?php $active = 'active';
                foreach (($logs ?? []) as $key => $log) : ?>
                    <div class="tab-pane fade show <?= $active ?>"
                         id="list-<?= $key ?>" role="tabpanel"
                         aria-labelledby="list-<?= $key ?>">
                        <h3><?= $log['date'] ?? '' ?></h3>
                        <?= $log['message'] ?? '' ?>
                    </div>
                    <?php $active = '';
                endforeach; ?>
            </div>
        </div>
    </div>
</div>
