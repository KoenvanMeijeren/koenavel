<?php

use App\Src\Core\URI;
use App\Src\Translation\Translation;

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
    <?php if (strstr(URI::getUrl(), 'admin')) : ?>
        <link rel="stylesheet" href="/resources/assets/admin/css/login.css">
    <?php endif; ?>

        <title><?= $data['title'] ?? 'Undefined' ?></title>
    </head>
    <body>
        <div class="container-fluid">
            <?= $content ?? '' ?>
        </div>

        <footer>
            <!-- Jquery -->
            <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
                    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
                    crossorigin="anonymous"></script>

            <!-- Bootstrap -->
            <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
        </footer>
    </body>
</html>
