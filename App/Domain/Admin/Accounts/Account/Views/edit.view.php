<?php
declare(strict_types=1);

use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Repositories\AccountRepository;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Translation\Translation;

$request = new Request();
$account = new AccountRepository($account ?? null);
$rights = (int)$request->post('rights');
$rights = $rights !== 0 ? $rights : $account->getRights();
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
                <form method="post"
                      action="/admin/account/edit/<?= $account->getId() ?>/store/data">
                    <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/data') ?>

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
                                       value="<?= $request->post('name') !== '' ?
                                           $request->post('name') : $account->getName() ?>"
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
                                            <?= $rights === User::ADMIN ? 'selected' : '' ?>>
                                        <?= Translation::get('form_rights_admin') ?>
                                    </option>
                                    <option value="<?= User::SUPER_ADMIN ?>"
                                            <?= $rights === User::SUPER_ADMIN ? 'selected' : '' ?>>
                                        <?= Translation::get('form_rights_super_admin') ?>
                                    </option>
                                    <option value="<?= User::DEVELOPER ?>"
                                            <?= $rights === User::DEVELOPER ? 'selected' : '' ?>>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('admin_edit_email_account_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post"
                      action="/admin/account/edit/<?= $account->getId() ?>/store/email">
                    <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/email') ?>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="email">
                                    <?= Translation::get('form_email') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="email"
                                       name="email"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_email') ?>"
                                       value="<?= $request->post('email') !== '' ?
                                           $request->post('email') : $account->getEmail() ?>"
                                       required>
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
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?= Translation::get('admin_edit_password_account_title') ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post"
                      action="/admin/account/edit/<?= $account->getId() ?>/store/password">
                    <?= CSRF::insertToken('/admin/account/edit/' . $account->getId() . '/store/password') ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="password">
                                    <?= Translation::get('form_new_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password" name="password"
                                       id="password"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_new_password') ?>"
                                       required>
                                <meter max="4" id="password-strength-meter"
                                       value="0"></meter>
                                <p id="password-strength-text"></p>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="confirmationPassword">
                                    <?= Translation::get('form_confirmation_password') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <input type="password"
                                       name="confirmationPassword"
                                       id="confirmationPassword"
                                       class="form-control"
                                       placeholder="<?= Translation::get('form_confirmation_password') ?>"
                                       required>
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

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <?php if ($account->isBlocked()) : ?>
                    <div class="card-text mb-4">
                        <h4 class="card-title">
                            Account is geblokkeerd
                        </h4>
                    </div>

                    <form method="post"
                          action="/admin/account/unblock/<?= $account->getId() ?>">
                        <button type="submit"
                                class="btn btn-success">
                            <?= Translation::get('unblock_button') ?>
                            <i class="far fa-save"></i>
                        </button>
                        <div class="clearfix"></div>
                    </form>
                <?php else : ?>
                    <div class="card-text mb-4">
                        <h4 class="card-title">
                            Account blokkeren?
                        </h4>
                    </div>

                    <form method="post"
                          action="/admin/account/block/<?= $account->getId() ?>">
                        <button type="submit"
                                class="btn btn-danger">
                            <?= Translation::get('block_button') ?>
                            <i class="far fa-save"></i>
                        </button>
                        <div class="clearfix"></div>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
