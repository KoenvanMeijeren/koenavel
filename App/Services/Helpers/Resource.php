<?php
declare(strict_types=1);


namespace App\Services\Helpers;

use App\Src\Translation\Translation;

final class Resource
{
    public static function loadFlashMessage(): void
    {
        includeFile(RESOURCES_PATH . '/views/partials/flash.view.php');
    }

    public static function addTableEditColumn(
        string $editAction,
        string $destroyAction,
        string $destroyMessageWarning
    ): string {
        return '<div class="table-edit-row flex">
                    <a href="'.$editAction.'"
                       class="btn btn-success flex-child"
                       data-toggle="tooltip"
                       data-placement="top"
                       title="'.Translation::get('table_row_edit').'">
                        <i class="fas fa-user-edit"></i>
                    </a>

                    <form method="post" 
                          action="'.$destroyAction.'">
                        <button class="btn btn-danger flex-child" 
                                type="submit" 
                                data-toggle="tooltip" 
                                data-placement="top"
                                title="'.Translation::get('table_row_delete').'" 
                                onclick="return confirm(\''.$destroyMessageWarning.'\')">
                            <i class="fas fa-trash-alt"></i>
                        </button>
                    </form>     
                </div>';
    }
}
