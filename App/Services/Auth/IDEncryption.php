<?php
declare(strict_types=1);


namespace App\Services\Auth;

use App\Src\Config\Config;
use Exception;

final class IDEncryption
{
    /**
     * The secret token.
     *
     * @var string
     */
    private $secretToken;

    public function __construct()
    {
        $config = new Config();

        $this->secretToken = $config->get('secretKey')->toString();
    }

    /**
     * Safely generate the random unique token.
     *
     * @return string
     * @throws Exception
     */
    public function generateToken(): string
    {
        return bin2hex(random_bytes(200));
    }

    /**
     * Encrypt the id to make sure that it cannot be read by attackers.
     *
     * @param string $id the id to be encrypted
     * @param string $token the token which will be used to encrypt the id.
     *
     * @return string
     * @throws Exception
     */
    public function encrypt(
        string $id,
        string $token
    ): string {
        $string = $id . ':' . $token;
        $string .= ':' . hash_hmac('sha256', $string, $this->secretToken);

        return $string;
    }

    /**
     * Decrypt the encrypted id.
     *
     * @param string $encryptedId
     *
     * @return int the decrypted id.
     */
    public function decrypt(string $encryptedId): int
    {
        if (strlen($encryptedId) <= 1) {
            return 0;
        }

        list($id, $token, $mac) = explode(':', $encryptedId);

        if (!hash_equals(
            hash_hmac(
                'sha256',
                $id . ':' . $token,
                $this->secretToken
            ),
            $mac
        )) {
            return 0;
        }

        return (int) $id;
    }

    /**
     * Make sure that the user is the user which he says he is.
     *
     * @param string $userToken     the login token of the user.
     * @param string $encryptedId   the encrypted id of the user.
     *
     * @return bool
     */
    public function validateHash(
        string $userToken,
        string $encryptedId
    ): bool {
        if ($encryptedId === '') {
            return true;
        }

        if (strlen($encryptedId) <= 1) {
            return false;
        }

        list($id, $token, $mac) = explode(':', $encryptedId);

        if (hash_equals($userToken, $token)) {
            return true;
        }

        return false;
    }
}
