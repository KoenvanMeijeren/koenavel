<?php
declare(strict_types=1);


namespace App\Domain\Admin\Authentication\Support;

use App\Src\Core\Request;
use Exception;

final class IDEncryption
{
    private string $secretToken;

    public function __construct()
    {
        $request = new Request();

        $this->secretToken = $request->env('secretKey');
    }

    /**
     * Safely generate the random unique token.
     *
     * @param int $length the length of the token
     *
     * @return string
     * @throws Exception
     */
    public function generateToken(int $length = 200): string
    {
        return bin2hex(random_bytes($length));
    }

    /**
     * Encrypt the id to make sure that it cannot be read by attackers.
     *
     * @param int    $id    the id to be encrypted
     * @param string $token the token which will be used to encrypt the id.
     *
     * @return string
     * @throws Exception
     */
    public function encrypt(
        int $id,
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
        if ($encryptedId === '') {
            return 0;
        }

        [$id, $token, $mac] = explode(':', $encryptedId);

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

        [$id, $token, $mac] = explode(':', $encryptedId);

        return hash_equals($userToken, $token);
    }
}
