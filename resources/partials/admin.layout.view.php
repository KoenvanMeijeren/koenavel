<?php

use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Support\Converter;
use App\Domain\Support\Resource;
use App\Src\Core\URI;
use App\Src\Translation\Translation;

$user = new User();
$rights = new Converter($user->getRights())
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet" type="text/css"
          href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <!-- Font awesome -->
    <script type="text/javascript" charset="utf8"
            src="/resources/assets/vendor/fontawesome/fontawesome.js"></script>

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/vendor/cms-theme/css/light-bootstrap-dashboard.css">
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/admin/css/style.css">

    <!-- Data tables -->
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/vendor/datatables/css/dataTables.bootstrap4.min.css">

    <!-- Datepicker -->
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/vendor/datepicker/css/datepicker.css">

    <?php if (!$user->isLoggedIn()) : ?>
        <!-- Login CSS -->
        <link rel="stylesheet" type="text/css"
              href="/resources/assets/admin/css/login.css">
    <?php endif; ?>

    <!-- Title -->
    <title><?= $data['title'] ?? 'Undefined' ?></title>

    <!-- Fav icon -->
    <link rel="icon" type="image/png" sizes="96x96"
          href="/resources/assets/admin/images/favicon/favicon-96x96.png">
</head>
<body>
<?php if ($user->isLoggedIn()) : ?>
    <div class="wrapper">
        <div class="sidebar" data-color="orange"
             data-image="/resources/assets/vendor/cms-theme/img/sidebar-5.jpg">
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
                            'pages') !== false ? 'active' : '' ?>">
                            <a class="nav-link" href="/admin/pages">
                                <i class="fas fa-sitemap"></i>
                                <p>
                                    <?= Translation::get('admin_menu_pages') ?>
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
                                    <b><?= $rights->toReadableRights() ?></b>
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
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/jquery/jquery-3.3.1.js"></script>

<!-- Bootstrap -->
<script type="text/javascript" charset="utf8"
        src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>

<!-- Popper js -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/popper/popper.min.js"></script>

<!-- Data tables -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/datatables/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" charset="utf8"
        src="/resources/assets/admin/js/datatables.js"></script>

<!-- Datepicker -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/datepicker/js/datepicker.js"></script>

<!-- Password strength indicator -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/password-strength-indicator/zxcvbn.js"></script>
<script type="text/javascript" charset="utf8"
        src="/resources/assets/admin/js/password-strength-indicator.js"></script>

<!-- Theme js -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/cms-theme/js/light-bootstrap-dashboard.js"></script>
<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/cms-theme/js/plugins/bootstrap-notify.js"></script>

<script type="text/javascript" charset="utf8"
        src="/resources/assets/vendor/tinymce/tinymce.js"></script>

<!-- Default JS -->
<script type="text/javascript" charset="utf8"
        src="/resources/assets/admin/js/default.js"></script>
</body>
</html>
