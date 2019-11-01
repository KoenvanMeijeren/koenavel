<?php
declare(strict_types=1);

/*
 * Rights:
 * 0 = Accessible for everyone
 * 1 = student
 * 2 = teacher
 * 3 = Admin
 * 4 = Super admin.
 */

use App\Controllers\PageController;
use App\Src\Core\Router;

// Pages.
Router::get('', PageController::class,
    'index', 0);
Router::get('account', PageController::class,
    'all', 0);
Router::get('account/{slug}', PageController::class,
    'show', 0);

// Page not found.
Router::get('fourNullFour', PageController::class,
    'notFound', 0);
