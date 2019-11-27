<?php

use App\Src\Core\Request;
use App\Src\Translation\Translation;

$request = new Request();
?>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('admin_edit_regular_data_account_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="/admin/user/account/store/data">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="name">
                                    <?= Translation::get('form_name') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="text" name="name" id="name"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_name') ?>"
                                       value="<?= !empty($request->post('name')) ?
                                           $request->post('name') : $account->account_name ?? '' ?>"
                                       required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="email">
                                    <?= Translation::get('form_email') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_email') ?>"
                                       value="<?= $account->account_email ?? '' ?>"
                                       disabled
                                       required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default-small float-right">
                        <?= Translation::get('save_button') ?>
                        <i class="far fa-save"></i>
                    </button>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('admin_edit_password_account_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="/admin/user/account/store/password">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="currentPassword">
                                    <?= Translation::get('form_current_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="currentPassword"
                                       id="currentPassword"
                                       class="form-control"
                                       value="<?= $request->post('currentPassword') ?>"
                                       placeholder="<?= Translation::get('form_current_password') ?>"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="newPassword">
                                    <?= Translation::get('form_new_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="newPassword"
                                       id="newPassword"
                                       class="form-control"
                                       value="<?= $request->post('newPassword') ?>"
                                       placeholder="<?= Translation::get('form_new_password') ?>"
                                       required>
                                <meter max="4" id="password-strength-meter" value="0"></meter>
                                <p id="password-strength-text"></p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="confirmationPassword">
                                    <?= Translation::get('form_confirmation_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="confirmationPassword"
                                       id="confirmationPassword"
                                       class="form-control"
                                       value="<?= $request->post('confirmationPassword') ?>"
                                       placeholder="<?= Translation::get('form_confirmation_password') ?>"
                                       required>
                            </div>
                        </div>
                    </div>

                    <button type="submit" class="btn btn-default-small float-right">
                        <?= Translation::get('save_button') ?>
                        <i class="far fa-save"></i>
                    </button>

                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
</div>
