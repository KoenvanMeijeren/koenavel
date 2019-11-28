<?php
declare(strict_types=1);


namespace App\Models\Admin\Account;

use App\Models\User;
use App\Src\Core\Request;
use App\Src\Core\Router;
use App\Src\Model\BaseModel;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

class Account extends BaseModel
{
    /**
     * @var User
     */
    protected $user;

    /**
     * @var Session
     */
    protected $session;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $email;

    /**
     * @var string
     */
    protected $password;

    /**
     * @var string
     */
    protected $confirmationPassword;

    /**
     * @var int
     */
    protected $rights;

    public function __construct()
    {
        $this->user = new User();
        $this->session = new Session();

        $this->table = 'account';
        $this->setColumns('*');

        $this->idColumn = 'account_ID';
        $this->softDeleteColumn = 'account_is_deleted';
        $this->id = (int) Router::getWildcard();

        $request = new Request();
        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->confirmationPassword = $request->post('confirmationPassword');
        $this->rights = (int) $request->post('rights');
    }

    public function getID(): int
    {
        return $this->id;
    }

    /**
     * @return stdClass
     */
    public function get(): stdClass
    {
        $this->setDefaultFilters();
        $this->setIDFilter();

        return $this->getBy();
    }

    public function getByEmail(string $email): stdClass
    {
        $this->setDefaultFilters();
        $this->setEmailFilter($email);

        return $this->getBy();
    }

    /**
     * @return object[]
     */
    public function getAll(): array
    {
        $this->setDefaultFilters();

        return $this->getAllBy();
    }

    public function block(): bool
    {
        if ($this->user->getID() === $this->id) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_edit_own_account_block_state_message')
            );

            return false;
        }

        $this->setIDFilter();
        $this->changeBlockState(1);
        parent::save();

        return true;
    }

    public function unblock(): bool
    {
        if ($this->user->getID() === $this->id) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_edit_own_account_unblock_state_message')
            );

            return false;
        }

        $this->setIDFilter();
        $this->changeBlockState(0);
        parent::save();

        return true;
    }

    public function delete(): bool
    {
        if ($this->user->getID() === $this->id) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_delete_own_account_message')
            );

            return false;
        }

        $this->setIDFilter();
        parent::delete();

        if (empty((array) $this->get())) {
            return true;
        }

        $this->session->flash(
            State::FAILED,
            Translation::get('admin_deleted_account_failed_message')
        );

        return false;
    }

    protected function setIDFilter(): void
    {
        $this->setFilter(
            $this->idColumn,
            '=',
            (string) $this->id
        );
    }

    protected function setDefaultFilters(): void
    {
        $this->setFilter(
            $this->softDeleteColumn,
            '=',
            '0'
        );
    }

    protected function setEmailFilter(string $email): void
    {
        $this->setFilter(
            'account_email',
            '=',
            $email
        );
    }

    protected function changeBlockState(int $state): void
    {
        $this->setFields([
            'account_is_blocked' => (string) $state
        ]);
    }
}
