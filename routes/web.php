<?php
declare(strict_types=1);

use App\Controllers\Admin\AccountController;
use App\Controllers\Admin\AuthorizationController;
use App\Controllers\Admin\DashboardController;
use App\Controllers\Admin\DebugController;
use App\Controllers\Admin\PageController as AdminPageController;
use App\Controllers\Admin\UserAccountController;
use App\Controllers\PageController;
use App\Models\User;
use App\Src\Core\Router;

/**
 * TEST routes
 */
Router::get('test', PageController::class,
    'test');

/**
 * Pages routes.
 */
Router::get('', PageController::class,
    'index', User::GUEST);

/**
 * Admin routes.
 */
Router::prefix('admin')->group(function () {
    /**
     * Authorization routes.
     */
    Router::get('', AuthorizationController::class,
        'index', User::GUEST);
    Router::post('login', AuthorizationController::class,
        'login', User::GUEST);
    Router::get('logout', AuthorizationController::class,
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

    /**
     * Account maintenance routes.
     */
    Router::get('account', AccountController::class,
        'index', User::SUPER_ADMIN);
    Router::get('account/create', AccountController::class,
        'create', User::SUPER_ADMIN);
    Router::post('account/create/store', AccountController::class,
        'store', User::SUPER_ADMIN);
    Router::get('account/edit/{slug}', AccountController::class,
        'show', User::SUPER_ADMIN);
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
    'notFound', User::GUEST);
