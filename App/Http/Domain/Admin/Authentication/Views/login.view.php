<?php
declare(strict_types=1);

use App\Services\Helpers\Resource;
use App\Src\Security\CSRF;
use App\Src\Session\Session;
use App\Src\Translation\Translation;

$session = new Session();
?>
<div class="row">
    <div class="col-sm-10 offset-sm-1">
        <form class="form-signin" method="post" action="/admin/login">
            <?= CSRF::insertToken('/admin/login') ?>

            <div class="text-center mb-4">
                <h1 class="h3 mb-3 font-weight-normal">
                    <?= Translation::get('login_page_title') ?>
                </h1>

                <?php Resource::loadFlashMessage(); ?>
            </div>

            <div class="form-label-group">
                <input class="form-control"
                       type="email"
                       id="email"
                       name="email"
                       autofocus="autofocus"
                       required
                       placeholder="<?= Translation::get('form_email_placeholder') ?>">
                <label for="email">
                    <b><?= Translation::get('form_email') ?></b>
                </label>
            </div>

            <div class="form-label-group">
                <input class="form-control"
                       type="password"
                       id="password"
                       name="password"
                       required
                       placeholder="<?= Translation::get('form_password_placeholder') ?>">
                <label for="password">
                    <b><?= Translation::get('form_password') ?></b>
                </label>
            </div>

            <button class="btn btn-default border-0 w-100"
                    type="submit">
                <?= Translation::get('login_button') ?>
                <i class="fas fa-sign-in-alt"></i>
            </button>
        </form>
    </div>
</div>
