<?php
declare(strict_types=1);


namespace App\Services\Core;


use App\Services\Exceptions\Basic\DuplicatedKeyException;
use App\Services\Exceptions\Basic\InvalidKeyException;
use App\Services\Type\TypeChanger;

final class Config
{
    /**
     * The config items.
     *
     * @var array
     */
    private static $config = [];

    /**
     * Determine if the config is set up.
     *
     * @var bool
     */
    private static $isPrepared = false;

    /**
     * Set a new config item.
     *
     * @param string                      $key   the key of the value
     * @param string|int|float|array|bool $value the value of the key
     *
     * @throws DuplicatedKeyException
     */
    public static function set(string $key, $value): void
    {
        if (isset(self::$config[$key])) {
            throw new DuplicatedKeyException('There is already a config item specified with the same key: ' . $key);
        }

        if (is_scalar($value)) {
            self::$config[$key] = (new Sanitize($value))->data();
        }

        self::$config[$key] = $value;
    }

    /**
     * Get a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return TypeChanger
     *
     * @throws InvalidKeyException
     */
    public static function get(string $key): TypeChanger
    {
        if (!isset(self::$config[$key])) {
            throw new InvalidKeyException('There is no existing config item with the given key: ' . $key);
        }

        return new TypeChanger(self::$config[$key]);
    }

    /**
     * Unset a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return bool
     *
     * @throws InvalidKeyException
     */
    public static function unset(string $key): bool
    {
        if (!isset(self::$config[$key])) {
            throw new InvalidKeyException(
                'There is no existing config item with the given key: '
                . $key
            );
        }

        unset(self::$config[$key]);

        return true;
    }

    /**
     * Unset all config items.
     */
    public static function unsetAll(): void
    {
        self::$config = [];
    }

    /**
     * Change the state into set up.
     *
     * @param bool $state The prepare state of the config
     */
    public static function setPreparedState(bool $state = true): void
    {
        self::$isPrepared = $state;
    }

    /**
     * Get the config state.
     *
     * @return bool
     */
    public static function isPrepared(): bool
    {
        return self::$isPrepared;
    }
}
