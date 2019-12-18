<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\Actions;


use App\Src\State\State;
use App\Src\Translation\Translation;

final class CreateSettingAction extends SettingAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $this->setting->create([
            $this->setting->key => $this->key,
            $this->setting->valueKey => $this->value
        ]);

        if ($this->setting->getByKey($this->key) !== null) {
            $this->session->flash(
                State::SUCCESSFUL,
                sprintf(
                    Translation::get('setting_successful_created'),
                    $this->key
                )
            );

            return true;
        }

        $this->session->flash(
            State::FAILED,
            sprintf(
                Translation::get('setting_unsuccessful_created'),
                $this->key
            )
        );

        return false;
    }
}
