<?php

use App\Src\Translation\Translation;

?>
<!DOCTYPE html>
<html lang="<?= Translation::DUTCH_LANGUAGE_CODE ?>">
    <head>
        <title><?= $title ?></title>
    </head>
    <body>
        <?= $content ?>
    </body>
</html>
