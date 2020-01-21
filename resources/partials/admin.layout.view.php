<?php

use App\Domain\Admin\Accounts\Account\Support\AccountRightsConverter;
use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\Core\URI;
use App\Src\Translation\Translation;
use App\Support\Resource;

$user = new User();
$rights = new AccountRightsConverter($user->getRights())
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Title -->
    <title><?= $data['title'] ?? 'Undefined' ?></title>

    <!-- Fav icon -->
    <link rel="icon" type="image/png" sizes="96x96"
          href="/admin/images/favicon/favicon-96x96.png">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">

    <!-- Font awesome -->
    <script src="https://kit.fontawesome.com/ec953a682d.js"
            crossorigin="anonymous"></script>

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css"
          href="/vendor/cms-theme/css/light-bootstrap-dashboard.css">

    <!-- Data tables -->
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css"
          href="/vendor/datepicker/css/datepicker.css">

    <?php if (!$user->isLoggedIn()) : ?>
        <!-- Login CSS -->
        <link rel="stylesheet" type="text/css" href="/admin/css/login.css">
    <?php endif; ?>

    <!-- Customized theme css -->
    <link rel="stylesheet" type="text/css" href="/admin/css/style.css">

    <!-- Tiny MCE -->
    <script
        src="https://cdn.tiny.cloud/1/amyz5vlo9d4hlbop0b78rh9earl2dxn0ljxerv4vuyfcqawj/tinymce/5/tinymce.min.js"
        referrerpolicy="origin"></script>
</head>
<body>
<?php if ($user->isLoggedIn()) : ?>
    <div class="wrapper">
        <div class="sidebar" data-color="orange"
             data-image="/vendor/cms-theme/img/sidebar-5.jpg">
            <div class="sidebar-wrapper">
                <ul class="nav">
                    <?php if ($user->getRights() >= User::ADMIN) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'dashboard') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/dashboard">
                                <i class="fas fa-home"></i>
                                <p>
                                    <?= Translation::get('admin_menu_dashboard') ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'page') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/pages">
                                <i class="fas fa-sitemap"></i>
                                <p>
                                    <?= Translation::get('admin_menu_pages') ?>
                                </p>
                            </a>
                        </li>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'setting') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/settings">
                                <i class="fas fa-cogs"></i>
                                <p>
                                    <?= Translation::get('admin_menu_settings') ?>
                                </p>
                            </a>
                        </li>
                    <?php endif;
                    if ($user->getRights() >= User::SUPER_ADMIN) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'account') !== false && strpos(URI::getUrl(),
                            'user') === false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/account">
                                <i class="fas fa-users"></i>
                                <p>
                                    <?= Translation::get('admin_menu_accounts') ?>
                                </p>
                            </a>
                        </li>
                    <?php endif;
                    if ($user->getRights() >= User::DEVELOPER) : ?>
                        <li class="nav-item <?= strpos(URI::getUrl(),
                            'debug') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/debug">
                                <i class="fas fa-code"></i>
                                <p>
                                    <?= Translation::get('admin_menu_debug') ?>
                                </p>
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
        <div class="main-panel">
            <nav class="navbar navbar-expand-lg ">
                <div class="container-fluid">
                    <p class="navbar-brand font-weight-bold">
                        <?= $data['title'] ?? '' ?>
                    </p>
                    <button class="navbar-toggler navbar-toggler-right mr-3"
                            type="button" data-toggle="collapse"
                            aria-controls="navigation-index"
                            aria-expanded="false"
                            aria-label="Toggle navigation">
                        <i class="fas fa-bars"></i>
                    </button>

                    <div class="collapse navbar-collapse justify-content-end"
                         id="navigation">
                        <ul class="navbar-nav ml-auto">
                            <li class="nav-item">
                                <a class="nav-link color-default <?= strpos(URI::getUrl(),
                                    'user/account') !== false ? 'active-link' : '' ?>"
                                   href="/admin/user/account">
                                <span class="no-icon">
                                    <?= Translation::get('welcome_text') ?>
                                    <?= $user->getName() ?> -
                                    <b><?= $rights->toReadable() ?></b>
                                </span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link color-default"
                                   href="/admin/logout">
                                    <span class="no-icon">
                                        <?= Translation::get('logout_button') ?>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>

            <div class="scrollbox-vertical">
                <div class="content">
                    <div class="container-fluid">
                        <?php Resource::loadFlashMessage(); ?>

                        <?= $content ?? '' ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php else : ?>
    <div class="container-fluid">
        <?php Resource::loadFlashMessage(); ?>

        <?= $content ?? '' ?>
    </div>
<?php endif; ?>

<!-- Jquery -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>

<!-- Bootstrap -->
<script
    src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<!-- Data tables -->
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="/admin/js/datatables.js"></script>

<!-- Datepicker -->
<script type="text/javascript" charset="utf8"
        src="/vendor/datepicker/js/datepicker.js"></script>

<!-- Password strength indicator -->
<script type="text/javascript" charset="utf8"
        src="/vendor/password-strength-indicator/zxcvbn.js"></script>
<script type="text/javascript" charset="utf8"
        src="/admin/js/password-strength-indicator.js"></script>

<!-- Theme js -->
<script type="text/javascript" charset="utf8"
        src="/vendor/cms-theme/js/light-bootstrap-dashboard.js"></script>
<script type="text/javascript" charset="utf8"
        src="/vendor/cms-theme/js/plugins/bootstrap-notify.js"></script>

<!-- Initialize the Tiny Mce editor -->
<script type="text/javascript" charset="utf8"
        src="/js/tinymce/tinymce.js"></script>

<!-- Default JS -->
<script type="text/javascript" charset="utf8"
        src="/admin/js/default.js"></script>
</body>
</html>
