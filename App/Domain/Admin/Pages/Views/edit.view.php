<?php
declare(strict_types=1);

use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Admin\Pages\Models\Page;
use App\Domain\Admin\Pages\Repositories\PageRepository;
use App\Src\Core\Request;
use App\Src\Security\CSRF;
use App\Src\Translation\Translation;

$page = new PageRepository($page ?? null);
$user = new User();
$request = new Request();

$disabled = '';
if ($user->getRights() !== User::DEVELOPER
    && $page->getInMenu() === Page::PAGE_STATIC
) {
    $disabled = 'disabled';
}

$action = '/admin/page/create/store';
if ($page->getId() !== 0) {
    $action = '/admin/page/edit/' . $page->getId() . '/store';
}
$pageInMenu = (int)$request->post('pageInMenu', (string)$page->getInMenu());
?>
<div class="row">
    <div class="col-sm-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title float-left">
                    <?= $title ?? '' ?>
                </h4>

                <div class="float-right">
                    <?php if ($disabled === '' && $page->isPublished()) : ?>
                        <form method="post"
                              action="/admin/page/unpublish/<?= $page->getId() ?>">
                            <?= CSRF::insertToken('/admin/page/unpublish/' . $page->getId()) ?>

                            <button type="submit" class="btn btn-danger">
                                <?= Translation::get('unpublish_button') ?>
                            </button>
                        </form>
                    <?php elseif ($disabled === '') : ?>
                        <form method="post"
                              action="/admin/page/publish/<?= $page->getId() ?>">
                            <?= CSRF::insertToken('/admin/page/publish/' . $page->getId()) ?>

                            <button type="submit" class="btn btn-success">
                                <?= Translation::get('publish_button') ?>
                            </button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
            <div class="card-body">
                <form method="post" action="<?= $action ?>">
                    <?= CSRF::insertToken($action) ?>

                    <div class="row">
                        <div class="col-sm-6">
                            <label for="slug">
                                <?= Translation::get('form_page_slug') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="slug" id="slug"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_page_slug') ?>"
                                   value="<?= $request->post(
                                       'slug',
                                       $page->getSlug()
                                   ) ?>"
                                   <?= $disabled ?>
                                   required>
                        </div>
                        <div class="col-sm-6">
                            <label for="title">
                                <?= Translation::get('form_title') ?>
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text" name="title" id="title"
                                   class="form-control"
                                   placeholder="<?= Translation::get('form_title') ?>"
                                   value="<?= $request->post(
                                       'title',
                                       $page->getTitle()
                                   ) ?>"
                                   required>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="pageInMenu">
                                    <?= Translation::get('form_show_page_in_menu') ?>
                                    <span class="text-danger">*</span>
                                </label>

                                <select id="pageInMenu"
                                        class="form-control"
                                        name="pageInMenu"
                                        <?= $disabled ?>
                                        required>
                                    <option
                                        value="<?= Page::PAGE_NOT_IN_MENU ?>"
                                        <?= $pageInMenu === Page::PAGE_NOT_IN_MENU ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_not_in_menu') ?>
                                    </option>
                                    <option
                                        value="<?= Page::PAGE_PUBLIC_IN_MENU ?>"
                                        <?= $pageInMenu === Page::PAGE_PUBLIC_IN_MENU ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_public_in_menu') ?>
                                    </option>
                                    <option
                                        value="<?= Page::PAGE_LOGGED_IN_IN_MENU ?>"
                                        <?= $pageInMenu === Page::PAGE_LOGGED_IN_IN_MENU ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_logged_in_in_menu') ?>
                                    </option>
                                    <option value="<?= Page::PAGE_STATIC ?>"
                                            <?= $pageInMenu === Page::PAGE_STATIC ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_static') ?>
                                    </option>
                                    <option value="<?= Page::PAGE_IN_FOOTER ?>"
                                            <?= $pageInMenu === Page::PAGE_IN_FOOTER ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_in_footer') ?>
                                    </option>
                                    <option
                                        value="<?= Page::PAGE_IN_MENU_AND_IN_FOOTER ?>"
                                        <?= $pageInMenu === Page::PAGE_IN_MENU_AND_IN_FOOTER ? 'selected' : '' ?>>
                                        <?= Translation::get('form_show_page_in_menu_and_in_footer') ?>
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="content">
                                    <?= Translation::get('form_page_content') ?>
                                    <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="content"
                                          rows="10"
                                          name="content"><?= parseHTMLEntities($request->post(
                                        'content',
                                        $page->getContent()
                                    )) ?></textarea>
                            </div>
                        </div>
                    </div>

                    <a href="/admin/pages"
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
