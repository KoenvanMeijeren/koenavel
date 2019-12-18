<?php
declare(strict_types=1);


namespace App\Domain\Admin\Settings\Actions;


use App\Domain\Admin\Accounts\User\Models\User;
use App\Domain\Admin\Settings\Models\Setting;
use App\Domain\Admin\Settings\Repositories\SettingRepository;
use App\Src\Action\FormAction;
use App\Src\Core\Request;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use App\Src\Validate\form\FormValidator;

abstract class SettingAction extends FormAction
{
    protected Setting $setting;
    protected SettingRepository $settingRepository;
    protected Session $session;

    protected string $key;
    protected string $value;

    public function __construct(Setting $setting)
    {
        $this->setting = $setting;
        $this->settingRepository = new SettingRepository(
            $this->setting->find($this->setting->getID())
        );
        $this->session = new Session();
        $request = new Request();

        $this->key = $request->post('setting_key');
        if ($this->key === '') {
            $this->key = $this->settingRepository->getKey();
        }

        $this->value = $request->post('setting_value');
    }

    protected function authorize(): bool
    {
        $user = new User();
        if ($this->key !== $this->settingRepository->getKey()
            && $user->getRights() !== User::DEVELOPER
        ) {
            $this->session->flash(
                State::FAILED,
                Translation::get('setting_editing_key_not_allowed')
            );

            return false;
        }

        return parent::authorize();
    }

    /**
     * @inheritDoc
     */
    protected function validate(): bool
    {
        $validator = new FormValidator();

        $validator->input($this->key, 'Sleutel')->isRequired();
        $validator->input($this->value, 'Waarde')->isRequired();

        if ($this->key !== $this->settingRepository->getKey()) {
            $validator->input($this->key)
                ->isUnique(
                    $this->setting->getByKey($this->key),
                    sprintf(
                        Translation::get('setting_already_exists'),
                        $this->key
                    )
                );
        }

        return $validator->handleFormValidation();
    }
}
