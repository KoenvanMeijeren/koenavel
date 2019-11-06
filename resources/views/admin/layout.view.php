<?php

use App\Services\Helpers\Resource;
use App\Src\Core\URI;
use App\Src\Translation\Translation;

$user = new \App\Models\User();
?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport"
          content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap -->
    <link rel="stylesheet"
          href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">

    <!-- Data tables -->
    <link rel="stylesheet" type="text/css"
          href="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.css">
    <link rel="stylesheet" type="text/css"
          href="https://cdn.datatables.net/1.10.20/css/dataTables.semanticui.min.css">

    <!-- Theme css -->
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/admin/vendor/cms-theme/css/light-bootstrap-dashboard.css">
    <link rel="stylesheet" type="text/css"
          href="/resources/assets/admin/css/style.css">

    <!-- Custom CSS -->
    <?php if (!$user->isLoggedIn()) : ?>
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
         data-image="/resources/assets/admin/vendor/cms-theme/img/sidebar-5.jpg">
        <div class="sidebar-wrapper">
            <ul class="nav">
                <li class="nav-item <?= strstr(URI::getUrl(), 'dashboard') ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/dashboard">
                        <i class="fas fa-home"></i>
                        <p>Dashboard</p>
                    </a>
                </li>
                <li class="nav-item <?= strstr(URI::getUrl(), 'pages') ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/pages">
                        <i class="fas fa-sitemap"></i>
                        <p>Pagina's</p>
                    </a>
                </li>
                <li class="nav-item <?= strstr(URI::getUrl(), 'account') ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/account">
                        <i class="fas fa-users"></i>
                        <p>Accounts</p>
                    </a>
                </li>
                <li class="nav-item <?= strstr(URI::getUrl(), 'debug') ? 'active' : '' ?>">
                    <a class="nav-link" href="/admin/debug">
                        <i class="fas fa-code"></i>
                        <p>Debuggen</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="main-panel">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg " color-on-scroll="500">
            <div class="container-fluid">
                <p class="navbar-brand font-weight-bold">
                    <?= $data['title'] ?? '' ?>
                </p>
                <!-- Mobile navbar toggle -->
                <button class="navbar-toggler navbar-toggler-right mr-3"
                        type="button" data-toggle="collapse"
                        aria-controls="navigation-index" aria-expanded="false"
                        aria-label="Toggle navigation">
                    <i class="fas fa-bars"></i>
                </button>

                <!-- Top right bar -->
                <div class="collapse navbar-collapse justify-content-end"
                     id="navigation">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <a class="nav-link color-default" href="/admin/user/account">
                                <span class="no-icon">
                                    Welkom <?= $user->getName() ?>
                                </span>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link color-default" href="/admin/logout">
                                <span class="no-icon">Uitloggen</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- End Navbar -->
        <div class="content">
            <div class="container-fluid">
                <?php Resource::loadFlashMessage(); ?>

                <?= $content ?? '' ?>
            </div>
        </div>
    </div>
</div>
<?php else : ?>
    <?= $content ?? '' ?>
<?php endif; ?>

        <footer>
            <!-- Jquery -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>

            <!-- Bootstrap -->
            <script
                src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Popper js -->
            <script src="/resources/assets/admin/js/popper.min.js"></script>

            <!-- Font awesome -->
            <script src="https://kit.fontawesome.com/ec953a682d.js"
                    crossorigin="anonymous"></script>

            <!-- Data tables -->
            <script type="text/javascript" charset="utf8"
                    src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.js"></script>
            <script type="text/javascript" charset="utf8"
                    src="https://cdn.datatables.net/1.10.19/js/dataTables.semanticui.min.js"></script>
            <script type="text/javascript" charset="utf8"
                    src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>
            <script src="/resources/assets/admin/js/datatables.js"></script>

            <!-- Theme js -->
            <script type="text/javascript" charset="utf8"
                    src="/resources/assets/admin/vendor/cms-theme/js/light-bootstrap-dashboard.js"></script>
        </footer>
</body>
</html>
