<?php

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

        <title><?= $title ?? 'Undefined' ?></title>
    </head>
    <body>
        <?= $content ?? '' ?>

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
