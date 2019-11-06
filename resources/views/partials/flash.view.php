<?php

use App\Src\Session\Session;

$session = new Session();

$error = $session->get('error', true);
if (!empty($error)) :
    ?>
    <div class="alert alert-danger rounded" role="alert">
        <?= $error ?>
    </div>
<?php endif; ?>

<?php
$message = $session->get('success', true);
if (!empty($message)) :
    ?>
    <div class="alert alert-success rounded" role="alert">
        <?= $message ?>
    </div>
<?php endif; ?>
