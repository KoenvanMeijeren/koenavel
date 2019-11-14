<?php

use App\Src\Session\Session;

$session = new Session();

$error = $session->get('error', true);
if (!empty($error)) :
    ?>
    <div data-notify="container" role="alert"
         class="col-11 col-sm-4 alert alert-danger alert-top-right shadow"
         data-notify-position="top-right">
        <button type="button" aria-hidden="true"
                class="close alert-button-center-right"
                data-dismiss="alert" data-notify="dismiss">
            <i class="nc-icon nc-simple-remove"></i>
        </button>

        <span data-notify="message"><?= $error ?></span>
    </div>
<?php endif; ?>

<?php
$message = $session->get('success', true);
if (!empty($message)) :
    ?>
    <div data-notify="container" role="alert"
         class="col-11 col-sm-4 alert alert-success alert-top-right shadow"
         data-notify-position="top-right">
        <button type="button" aria-hidden="true"
                class="close alert-button-center-right"
                data-dismiss="alert" data-notify="dismiss">
            <i class="nc-icon nc-simple-remove"></i>
        </button>

        <span data-notify="message"><?= $message ?></span>
    </div>
<?php endif; ?>
