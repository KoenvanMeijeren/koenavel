<?php

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

        <!-- Font awesome -->
        <script src="https://kit.fontawesome.com/ec953a682d.js"
                crossorigin="anonymous"></script>

        <!-- Custom CSS -->
        <link rel="stylesheet" href="/resources/assets/admin/css/style.css">
    <?php if (!$user->isLoggedIn()) : ?>
        <link rel="stylesheet" href="/resources/assets/admin/css/login.css">
    <?php endif; ?>

        <!-- Title -->
        <title><?= $data['title'] ?? 'Undefined' ?></title>

        <!-- Fav icon -->
        <link rel="apple-touch-icon" sizes="57x57"
              href="/resources/assets/admin/images/favicon/apple-icon-57x57.png">
        <link rel="apple-touch-icon" sizes="60x60"
              href="/resources/assets/admin/images/favicon/apple-icon-60x60.png">
        <link rel="apple-touch-icon" sizes="72x72"
              href="/resources/assets/admin/images/favicon/apple-icon-72x72.png">
        <link rel="apple-touch-icon" sizes="76x76"
              href="/resources/assets/admin/images/favicon/apple-icon-76x76.png">
        <link rel="apple-touch-icon" sizes="114x114"
              href="/resources/assets/admin/images/favicon/apple-icon-114x114.png">
        <link rel="apple-touch-icon" sizes="120x120"
              href="/resources/assets/admin/images/favicon/apple-icon-120x120.png">
        <link rel="apple-touch-icon" sizes="144x144"
              href="/resources/assets/admin/images/favicon/apple-icon-144x144.png">
        <link rel="apple-touch-icon" sizes="152x152"
              href="/resources/assets/admin/images/favicon/apple-icon-152x152.png">
        <link rel="apple-touch-icon" sizes="180x180"
              href="/resources/assets/admin/images/favicon/apple-icon-180x180.png">
        <link rel="icon" type="image/png" sizes="192x192"
              href="/resources/assets/admin/images/favicon/android-icon-192x192.png">
        <link rel="icon" type="image/png" sizes="32x32"
              href="/resources/assets/admin/images/favicon/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="96x96"
              href="/resources/assets/admin/images/favicon/favicon-96x96.png">
        <link rel="icon" type="image/png" sizes="16x16"
              href="/resources/assets/admin/images/favicon/favicon-16x16.png">
        <link rel="manifest" href="/resources/assets/admin/images/favicon/manifest.json">
        <meta name="msapplication-TileColor" content="#ffffff">
        <meta name="msapplication-TileImage"
              content="/resources/assets/admin/images/ms-icon-144x144.png">
        <meta name="theme-color" content="#ffffff">
    </head>
    <body>
        <div class="container-fluid">
            <?php if ($user->isLoggedIn()) : ?>
            <div class="row">
                <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                    <div class="sidebar-sticky">
                        <ul class="nav flex-column">
                            <li class="nav-item">
                                <a class="nav-link <?= URI::getUrl() === 'admin/dashboard' ? 'active' : '' ?>"
                                   href="/admin/dashboard">
                                    <span data-feather="home"></span>
                                    Dashboard
                                    <?php if (URI::getUrl() === 'admin/dashboard') : ?>
                                        <span class="sr-only">(current)</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= URI::getUrl() === 'admin/account' ? 'active' : '' ?>"
                                   href="/admin/account">
                                    <span data-feather="user"></span>
                                    Account
                                    <?php if (URI::getUrl() === 'admin/dashboard') : ?>
                                        <span class="sr-only">(current)</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link <?= URI::getUrl() === 'admin/logout' ? 'active' : '' ?>"
                                   href="/admin/logout">
                                    <span data-feather="log-out"></span>
                                    Uitloggen
                                    <?php if (URI::getUrl() === 'admin/dashboard') : ?>
                                        <span class="sr-only">(current)</span>
                                    <?php endif; ?>
                                </a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h2"><?= $data['title'] ?? '' ?></h1>
                </div>

                <?= $content ?? '' ?>
            </main>
            <?php else : ?>
                <?= $content ?? '' ?>
            <?php endif; ?>
        </div>

        <footer>
            <!-- Jquery -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>

            <!-- Bootstrap -->
            <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

            <!-- Feather icons -->
            <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.9.0/feather.min.js"></script>

            <!-- Default JS -->
            <script src="/resources/assets/admin/js/default.js"></script>
        </footer>
    </body>
</html>
