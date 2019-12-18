<?php
declare(strict_types=1);

use App\Src\Core\Env;
use App\Src\Core\Request;
use App\Src\Translation\Translation;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Applicatie status
                </h4>
            </div>
            <div class="card-body">
                <p class="font-weight-bold">
                    <?= ucfirst($env ?? Env::DEVELOPMENT) ?>
                </p>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Sessie instellingen
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionSettings ?? 'Geen sessie instellingen gevonden' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Sessie gegevens
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $sessionInformation ?? 'Geen sessie informatie gevonden' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Cookie gegevens
                </h4>
            </div>
            <div class="card-body scrollbox-horizontal">
                <?= $cookieInformation ?? 'Geen cookie informatie gevonden' ?>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <div class="float-left">
                    <h4 class="card-title">
                        Log informatie
                    </h4>

                    <?php if (sizeof($logs ?? []) < 1) : ?>
                        <p class="mt-2 font-weight-bold">
                            Er is geen log data gevonden op
                            <?= $request->get('logDate') ?>.
                        </p>
                    <?php endif; ?>
                </div>

                <form class="form-inline float-right" method="get">
                    <div class="form-group mr-2">
                        <label for="datepicker"></label>
                        <input type="text" name="logDate"
                               autocomplete="off"
                               class="form-control" id="datepicker"
                               value="<?= $request->get('logDate') ?>">
                    </div>

                    <button class="btn btn-default-small border-0">
                        Filter
                    </button>
                </form>
            </div>
            <div class="card-body">
                <div class="row">
                    <?php if (sizeof($logs ?? []) > 0) : ?>
                        <div class="col-sm-4">
                            <div class="form-label-group">
                                <input type="text" id="searchLog"
                                       class="form-control"
                                       autocomplete="off"
                                       placeholder="Search">
                                <label for="searchLog">
                                    <b><?= Translation::get('form_search') ?></b>
                                </label>
                            </div>

                            <div class="scrollbox-vertical h-500">
                                <div class="list-group overflow-hidden"
                                     id="list-tab" role="tablist">
                                    <?php $active = 'active';
                                    foreach (($logs ?? []) as $key => $log) :
                                        if (strpos(
                                                $log['message'] ?? '',
                                                'ERROR'
                                            ) !== false
                                            || strpos(
                                                $log['message'] ?? '',
                                                'failed'
                                            ) !== false) {
                                            $class = 'active-danger';
                                        } else {
                                            $class = 'active-success';
                                        }
                                        ?>
                                        <a class="list-group-item list-group-item-action <?= $active . ' ' . $class ?>"
                                           id="list-<?= $key ?>-list"
                                           data-toggle="list"
                                           href="#list-<?= $key ?>" role="tab"
                                           aria-controls="<?= $key ?>">
                                            <?= $log['title'] ?? 'undefined' ?>
                                        </a>
                                        <?php $active = '';
                                    endforeach; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="tab-content" id="nav-tabContent">
                                <?php $active = 'active';
                                foreach (($logs ?? []) as $key => $log) : ?>
                                    <div
                                        class="tab-pane fade show <?= $active ?>"
                                        id="list-<?= $key ?>" role="tabpanel"
                                        aria-labelledby="list-<?= $key ?>">
                                        <h3 class="mt-0 pt-0"><?= $log['date'] ?? '' ?></h3>

                                        <ul class="list-group list-group-flush">
                                            <?php
                                            if (strpos(
                                                    $log['message'] ?? '',
                                                    'ERROR'
                                                ) !== false
                                                || strpos(
                                                    $log['message'] ?? '',
                                                    'failed'
                                                ) !== false
                                            ) {
                                                $class = 'list-group-item-danger';
                                            } else {
                                                $class = 'list-group-item-success';
                                            }
                                            ?>
                                            <li class="list-group-item <?= $class ?>">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        Bericht:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['message'] ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        URL:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->url ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        IP:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->ip ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        HTTP Method:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->http_method ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        Server:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->server ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        Referrer:
                                                    </div>
                                                    <div class="col-sm-10">
                                                        <?= $log['meta']->referrer ?? '' ?>
                                                    </div>
                                                </div>
                                            </li>
                                            <li class="list-group-item">
                                                <div class="row">
                                                    <div class="col-sm-2">
                                                        Process ID:
                                                    </div>
                                                    <div class="col-sm-10">
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
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <div class="scrollbox-vertical h-500">
                    <?= $phpinfo ?? '' ?>
                </div>
            </div>
        </div>
    </div>
</div>
