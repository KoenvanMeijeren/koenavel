<?php
declare(strict_types=1);

use App\Domain\Admin\Settings\Repositories\SettingRepository;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Translation\Translation;

$setting = new SettingRepository($setting ?? null);
$request = new Request();

$action = '/admin/setting/create/store';
if ($setting->get() !== null) {
    $action = "/admin/setting/edit/{$setting->getId()}/update";
}
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    <?php if ($setting->getKey() !== '') : ?>
                        Instelling '<?= $setting->getKey() ?>' bewerken
                    <?php else : ?>
                        Instelling toevoegen
                    <?php endif; ?>
                </h4>
            </div>
            <div class="card-body">
                <form method="post" action="<?= $action ?>">
                    <?= CSRF::insertToken($action) ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="setting_key">
                                <?= Translation::get('form_key') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="setting_key" id="setting_key"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_key') ?>"
                                   value="<?= $request->post(
                                       'setting_key',
                                       $setting->getKey()
                                   ) ?>"
                                   required>
                        </div>
                        <div class="col-sm-6">
                            <label for="setting_value">
                                <?= Translation::get('form_value') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="setting_value" id="setting_value"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_value') ?>"
                                   value="<?= $request->post(
                                       'setting_value',
                                       $setting->getValue()
                                   ) ?>"
                                   required>
                        </div>
                    </div>

                    <a href="/admin/settings"
                       class="btn btn-default-small float-left"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="<?= Translation::get('reset_button') ?>">
                        <?= Translation::get('reset_button') ?>
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
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">
                    Instellingen overzicht
                </h4>
            </div>
            <div class="card-body">
                <?= $settings ?? '' ?>
            </div>
        </div>
    </div>
</div>
