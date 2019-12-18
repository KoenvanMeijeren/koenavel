<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\Actions;

use App\Src\State\State;
use App\Src\Translation\Translation;

final class UpdateSettingAction extends SettingAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->setting->update($this->setting->getID(), [
            $this->setting->key => $this->key,
            $this->setting->valueKey => $this->value
        ]);

        $this->session->flash(
            State::SUCCESSFUL,
            sprintf(
                Translation::get('setting_successful_updated'),
                $this->key
            )
        );

        return true;
    }
}
