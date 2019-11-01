<?php
declare(strict_types=1);


namespace App\Src\Config;

use App\Src\Core\Env;
use App\Src\Exceptions\Basic\InvalidKeyException;
use App\Src\Type\TypeChanger;

final class Config extends Loader
{
    /**
     * The config items.
     *
     * @var array
     */
    private $config = [];

    public function __construct()
    {
        $env = new Env();

        $this->configLocation = CONFIG_PATH . '/production_config.php';
        if (Env::DEVELOPMENT === $env->getEnv()) {
            $this->configLocation = CONFIG_PATH . '/dev_config.php';
        }

        $this->config += $this->loadConfig();
    }

    /**
     * Get a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return TypeChanger
     * @throws InvalidKeyException
     */
    public function get(string $key): TypeChanger
    {
        if (!array_key_exists($key, $this->config)) {
            throw new InvalidKeyException(
                "There is no existing config item with key: {$key}"
            );
        }

        return new TypeChanger($this->config[$key]);
    }
}
