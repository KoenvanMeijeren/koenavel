<?php
declare(strict_types=1);

use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Translation\Translation;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('admin_create_account_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="/admin/account/create/store">
                    <?= CSRF::insertToken('/admin/account/create/store') ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">
                                    <?= Translation::get('form_name') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                       class="form-control"
                                       autocomplete="off"
                                       placeholder="<?= Translation::get('form_name') ?>"
                                       value="<?= $request->post('name')  ?>"
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">
                                    <?= Translation::get('form_email') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email" name="email"
                                       class="form-control"
                                       autocomplete="off"
                                       placeholder="<?= Translation::get('form_email') ?>"
                                       value="<?= $request->post('email') ?>"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">
                                    <?= Translation::get('form_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" id="password"
                                       name="password"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_password') ?>"
                                       required>
                                <meter max="4" id="password-strength-meter" value="0"></meter>
                                <p id="password-strength-text"></p>

                                <input type="password" id="password"
                                       name="confirmationPassword"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_confirmation_password') ?>"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="rights">
                                    <?= Translation::get('form_rights') ?>
                                    <span class="text-danger">*</span>
                                </label>

                                <select id="rights"
                                        class="form-control"
                                        name="rights"
                                        required>
                                    <option value="0">
                                        <?= Translation::get('form_choose_rights') ?>
                                    </option>
                                    <option value="<?= User::ADMIN ?>"
                                        <?= (int) $request->post('rights') === User::ADMIN ? 'selected' : '' ?>>
                                        <?= Translation::get('form_rights_admin') ?>
                                    </option>
                                    <option value="<?= User::SUPER_ADMIN ?>"
                                        <?= (int) $request->post('rights') === User::SUPER_ADMIN ? 'selected' : '' ?>>
                                        <?= Translation::get('form_rights_super_admin') ?>
                                    </option>
                                    <option value="<?= User::DEVELOPER ?>"
                                        <?= (int) $request->post('rights') === User::DEVELOPER ? 'selected' : '' ?>>
                                        <?= Translation::get('form_rights_developer') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <a href="/admin/account"
                       class="btn btn-default-small float-left"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="<?= Translation::get('back_button') ?>">
                        <i class="fas fa-arrow-left"></i>
                        <?= Translation::get('back_button') ?>
                    </a>

                    <button type="submit"
                            data-toggle="tooltip"
                            data-placement="top"
                            title="<?= Translation::get('save_button') ?>"
                            class="btn btn-default-small float-right">
                        <?= Translation::get('save_button') ?>
                        <i class="far fa-save"></i>
                    </button>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
