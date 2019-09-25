<?php
declare(strict_types=1);


namespace App\services\core;

use Exception;

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
     * @param string $key the key to save the value in
     * @param string|int|float|array|bool $value the value of the key
     *
     * @throws Exception
     */
    public static function set(string $key, $value)
    {
        if (isset(self::$config[$key])) {
            throw new Exception('There is already a config item specified with the same key: ' . $key);
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
     * @return string|int|float|array|bool
     *
     * @throws Exception
     */
    public static function get(string $key)
    {
        if (!isset(self::$config[$key])) {
            throw new Exception('There is no existing config item with the given key: ' . $key);
        }

        if (is_scalar(self::$config[$key])) {
            return (new Sanitize(self::$config[$key]))->data();
        }

        return self::$config[$key];
    }

    /**
     * Unset a config item.
     *
     * @param string $key the key to search for the corresponding value
     *
     * @return bool
     *
     * @throws Exception
     */
    public static function unset(string $key)
    {
        if (!isset(self::$config[$key])) {
            throw new Exception(
                'There is no existing config item with the given key: '
                . $key
            );
        }

        unset(self::$config[$key]);

        if (!isset(self::$config[$key])) {
            return true;
        }

        return false;
    }

    /**
     * Unset all config items.
     */
    public static function unsetAll()
    {
        self::$config = [];
    }

    /**
     * Change the state into set up.
     *
     * @param bool $state The prepare state of the config
     */
    public static function setPreparedState(bool $state = true)
    {
        self::$isPrepared = $state;
    }

    /**
     * Get the config state.
     *
     * @return bool
     */
    public static function isPrepared()
    {
        return self::$isPrepared;
    }
}
