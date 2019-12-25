<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\Actions;

use App\Domain\Admin\Accounts\User\Models\User;
use App\Src\State\State;
use App\Src\Translation\Translation;

final class CreateSettingAction extends SettingAction
{
    /**
     * @inheritDoc
     */
    protected function handle(): bool
    {
        $setting = $this->setting->firstOrCreate([
            $this->setting->key => $this->key,
            $this->setting->valueKey => $this->value
        ]);

        if ($setting !== null) {
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

    public function authorize(): bool
    {
        $user = new User();
        if ($user->getRights() !== User::DEVELOPER) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_creation_not_allowed')
            );

            return false;
        }

        return parent::authorize();
    }
}
