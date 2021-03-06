<?php
declare(strict_types=1);

use App\Domain\Admin\Accounts\Account\Controllers\AccountController;
use App\Domain\Admin\Accounts\User\Controllers\UserAccountController;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Admin\Authentication\Controllers\AuthenticationController;
use App\Domain\Admin\Dashboard\Controllers\DashboardController;
use App\Domain\Admin\Debug\Controllers\DebugController;
use App\Domain\Admin\File\Controllers\UploadFileController;
use App\Domain\Admin\Pages\Controllers\PageController as AdminPageController;
use App\Domain\Admin\Settings\Controllers\SettingsControllers;
use App\Domain\Pages\Controllers\PageController;
use App\Src\Core\Router;

/**
 * Pages routes.
 */
Router::get('', PageController::class,
    'index', User::GUEST);

/**
 * Admin routes.
 */
Router::prefix('admin')->group(static function () {
    /**
     * Authorization routes.
     */
    Router::get('', AuthenticationController::class,
        'index', User::GUEST);
    Router::post('login', AuthenticationController::class,
        'login', User::GUEST);
    Router::get('logout', AuthenticationController::class,
        'logout', User::ADMIN);

    /**
     * Dashboard routes.
     */
    Router::get('dashboard', DashboardController::class,
        'index', User::ADMIN);

    /**
     * Pages routes.
     */
    Router::get('pages', AdminPageController::class,
        'index', User::ADMIN);
    Router::get('page/create', AdminPageController::class,
        'create', User::ADMIN);
    Router::post('page/create/store', AdminPageController::class,
        'store', User::ADMIN);
    Router::get('page/edit/{slug}', AdminPageController::class,
        'edit', User::ADMIN);
    Router::post('page/edit/{slug}/store', AdminPageController::class,
        'update', User::ADMIN);
    Router::post('page/publish/{slug}', AdminPageController::class,
        'publish', User::ADMIN);
    Router::post('page/unpublish/{slug}', AdminPageController::class,
        'unPublish', User::ADMIN);
    Router::post('page/delete/{slug}', AdminPageController::class,
        'destroy', User::ADMIN);

    /**
     * File upload routes.
     */
    Router::post('upload/file', UploadFileController::class,
        'store', User::ADMIN);

    /**
     * Settings routes.
     */
    Router::get('settings', SettingsControllers::class,
        'index', User::ADMIN);
    Router::post('setting/create/store', SettingsControllers::class,
        'store', User::ADMIN);
    Router::get('setting/edit/{slug}', SettingsControllers::class,
        'edit', User::ADMIN);
    Router::post('setting/edit/{slug}/update', SettingsControllers::class,
        'update', User::ADMIN);
    Router::post('setting/delete/{slug}', SettingsControllers::class,
        'destroy', User::ADMIN);

    /**
     * Account routes.
     */
    Router::get('account', AccountController::class,
        'index', User::SUPER_ADMIN);
    Router::get('account/create', AccountController::class,
        'create', User::SUPER_ADMIN);
    Router::post('account/create/store', AccountController::class,
        'store', User::SUPER_ADMIN);
    Router::get('account/edit/{slug}', AccountController::class,
        'edit', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/data', AccountController::class,
        'storeData', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/email', AccountController::class,
        'storeEmail', User::SUPER_ADMIN);
    Router::post('account/edit/{slug}/store/password', AccountController::class,
        'storePassword', User::SUPER_ADMIN);
    Router::post('account/block/{slug}', AccountController::class,
        'block', User::SUPER_ADMIN);
    Router::post('account/unblock/{slug}', AccountController::class,
        'unblock', User::SUPER_ADMIN);
    Router::post('account/delete/{slug}', AccountController::class,
        'destroy', User::SUPER_ADMIN);

    /**
     * Debug routes.
     */
    Router::get('debug', DebugController::class,
        'index', User::DEVELOPER);

    /**
     * User routes.
     */
    Router::get('user/account', UserAccountController::class,
        'index', User::ADMIN);
    Router::post('user/account/store/data',
        UserAccountController::class,
        'storeData', User::ADMIN);
    Router::post('user/account/store/password',
        UserAccountController::class,
        'storePassword', User::ADMIN);
});

/**
 * Page not found route.
 */
Router::get('pageNotFound', PageController::class,
    'findOr404', User::GUEST);
