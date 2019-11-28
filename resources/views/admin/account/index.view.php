<?php

use App\Src\Translation\Translation;

?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">
                    <?= Translation::get('admin_accounts_maintenance_title') ?>
                </h4>

                <a href="/admin/account/create"
                   class="btn btn-default-small float-right"
                   data-toggle="tooltip"
                   data-placement="top"
                   title="Toevoegen">
                    <i class="fas fa-user-plus"></i>
                </a>
            </div>
            <div class="card-body">
                <?= $accounts ?? Translation::get('no_accounts_were_found_message') ?>
            </div>
        </div>

        <div class="clearfix"></div>
    </div>
</div>
