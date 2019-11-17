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
            <div class="list-group overflow-hidden" id="list-tab"
                 role="tablist">
                <?php $active = 'active';
                foreach (($logs ?? []) as $key => $log) :
                    if (strstr($log['message'] ?? '', 'ERROR')) {
                        $class = 'active-danger';
                    } else {
                        $class = 'active-success';
                    }
                    ?>
                    <a class="list-group-item list-group-item-action <?= $active . ' ' . $class ?>"
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

                        <ul class="list-group list-group-flush">
                            <?php
                            if (strstr(
                                $log['message'] ?? '', 'ERROR')
                            ) {
                                $class = 'list-group-item-danger';
                            } else {
                                $class = 'list-group-item-success';
                            }
                            ?>
                            <li class="list-group-item <?= $class ?>">
                                <div class="row">
                                    <div class="col-sm-1">
                                        Bericht:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['message'] ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        URL:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->url ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        IP:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->ip ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        HTTP Method:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->http_method ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        Server:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->server ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        Referrer:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->referrer ?? '' ?>
                                    </div>
                                </div>
                            </li>
                            <li class="list-group-item">
                                <div class="row">
                                    <div class="col-sm-1">
                                        Process ID:
                                    </div>
                                    <div class="col-sm-11">
                                        <?= $log['meta']->process_id ?? '' ?>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div>
                    <?php $active = '';
                endforeach; ?>
            </div>
        </div>
    </div>
</div>
