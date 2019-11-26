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
 * Pages.
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
     * The dashboard page.
     */
    Router::get('dashboard', DashboardController::class,
        'index', User::ADMIN);

    /**
     * The pages page.
     */
    Router::get('pages', AdminPageController::class,
        'index', User::ADMIN);

    /**
     * The account page.
     */
    Router::get('account', AccountController::class,
        'index', User::SUPER_ADMIN);

    /**
     * The debug page.
     */
    Router::get('debug', DebugController::class,
        'index', User::DEVELOPER);

    /**
     * The user page.
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
 * Page not found.
 */
Router::get('pageNotFound', PageController::class,
    'notFound', User::GUEST);
