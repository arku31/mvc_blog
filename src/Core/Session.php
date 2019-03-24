<?php
namespace App\Core;

class Session
{
    /**
     * @param $key
     * @param $value
     */
    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    /**
     * @param $key
     * @return null
     */
    public static function get($key)
    {
        return $_SESSION[$key] ?? null;
    }

    /**
     * Return&clean value
     * @param string $key
     * @return null
     */
    public static function getOnce(string $key)
    {
        $value = self::get($key);
        self::set($key, null);
        return $value;
    }
}