<?php
declare(strict_types=1);


namespace App\Models\Admin\Account;

use App\Models\User;
use App\Src\Core\Request;
use App\Src\Core\Router;
use App\Src\Model\Model;
use App\Src\Session\Session;
use App\Src\State\State;
use App\Src\Translation\Translation;
use stdClass;

class Account extends Model
{
    protected string $table = 'account';
    protected string $primaryKey = 'account_ID';
    protected string $softDeletedKey = 'account_is_deleted';

    /**
     * The encryption of the account password.
     *
     * @var int
     */
    public const PASSWORD_ENCRYPTION = PASSWORD_ARGON2ID;

    protected User $user;
    protected Account $account;
    protected Session $session;

    protected string $name;
    protected string $email;
    protected string $password;
    protected string $confirmationPassword;
    protected int $rights;

    public function __construct()
    {
        $this->user = new User();
        $this->session = new Session();
        $request = new Request();

        $this->name = $request->post('name');
        $this->email = $request->post('email');
        $this->password = $request->post('password');
        $this->confirmationPassword = $request->post('confirmationPassword');
        $this->rights = (int) $request->post('rights');
    }

    /**
     * Get the id of the account.
     *
     * @return int
     */
    public function getID(): int
    {
        return (int) Router::getWildcard();
    }

    /**
     * Get an account by the given email.
     *
     * @param string $email
     *
     * @return false|stdClass
     */
    public function getByEmail(string $email)
    {
        return $this->firstByAttributes([
            'account_email' => $email
        ]);
    }

    private function validateUser(int $id): bool
    {
        if ($this->user->getID() === $id) {
            $this->session->flash(
                State::FAILED,
                Translation::get('cannot_delete_own_account_message')
            );
            return false;
        }

        return true;
    }
}
