<?php

use App\Src\Core\Env;
use App\Src\Translation\Translation;

$request = new \App\Src\Core\Request();
?>
<div class="row mb-2">
    <h2 class="h4">
        Applicatie status:
        <span class="font-weight-bold">
            <?= $env ?? Env::DEVELOPMENT ?>
        </span>
    </h2>
    <hr>
</div>

<div class="row mb-2">
    <h2 class="h4">
        Sessie, opgeslagen gegevens in de sessie
    </h2>
    <hr>

    <div class="col-sm-12 scrollbox-horizontal">
        <?= $sessionSettings ?? 'Geen sessie instellingen gevonden' ?>
        <hr>
    </div>

    <div class="col-sm-12 scrollbox-horizontal">
        <?= $sessionInformation ?? 'Geen sessie informatie gevonden' ?>
        <hr>
    </div>
</div>


<div class="row mb-2">
    <h2 class="h4">
        Cookie, opgeslagen gegevens in cookie's
    </h2>

    <div class="col-sm-12 scrollbox-horizontal">
        <?= $cookieInformation ?? 'Geen cookie informatie gevonden' ?>
        <hr>
    </div>
</div>


<div class="row mb-2">
    <h2 class="h4">
        Log informatie
    </h2>

    <div class="col-sm-12">
        <form class="form-inline" method="get">
            <div class="form-group" id="datepicker">
                <input type="hidden" name="logDate"
                       value="<?= $request->get('logDate') ?>">
            </div>

            <button class="btn btn-default-small border-0">
                Filter
            </button>
        </form>
    </div>
</div>

<div class="row mb-2">
    <?php if (empty($logs ?? '')) : ?>
        <div class="col-sm-12">
            Er is geen log data gevonden op de gegeven datum.
        </div>
    <?php else : ?>
        <div class="col-sm-4 scrollbox-vertical h-500">
            <div class="form-label-group has-search">
                <input type="text" id="searchLog" class="form-control"
                       placeholder="Search">
                <label for="searchLog">
                    <b><?= Translation::get('form_search') ?></b>
                </label>
            </div>

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
        <div class="col-sm-8 scrollbox-vertical h-500">
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
    <?php endif; ?>
</div>
