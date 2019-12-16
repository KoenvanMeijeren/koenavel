<?php
declare(strict_types=1);


namespace App\Support;

use App\Src\Security\CSRF;
use App\Src\Translation\Translation;

final class Resource
{
    public static function loadFlashMessage(): void
    {
        includeFile(RESOURCES_PATH . '/partials/flash.view.php');
    }

    public static function addTableEditColumn(
        string $editAction,
        string $destroyAction,
        string $destroyMessageWarning,
        bool $disableDestroyButton = false
    ): string {
        $disabledDestroyButton = '';
        $removeBorder = '';
        if ($disableDestroyButton) {
            $removeBorder = 'border-0';
            $disabledDestroyButton = 'disabled';
        }

        return '<div class="table-edit-row flex">
                    <a href="' . $editAction . '"
                       class="btn btn-success flex-child edit-button"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="' . Translation::get('table_row_edit') . '">
                        <i class="fas fa-edit"></i>
                    </a>

                    <form method="post"
                          action="' . $destroyAction . '">
                          '.CSRF::insertToken($destroyAction).'
                        <button class="btn btn-danger flex-child edit-button ' . $removeBorder . '"
                                type="submit"
                                data-toggle="tooltip"
                                data-placement="top"
                                ' . $disabledDestroyButton . '
                                title="' . Translation::get('table_row_delete') . '"
                                onclick="return confirm(\'' . $destroyMessageWarning . '\')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>
                </div>';
    }
}
