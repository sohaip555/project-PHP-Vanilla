<?php

namespace Core;

class Session
{

    public static function has($key)
    {
        return (bool) static::get($_SESSION[$key]);
    }

    public static function put($key, $value)
    {
        $_SESSION[$key] = $value;
    }

    public static function get($key, $default = null)
    {
        return $_SESSION['_flash'][$key] ?? $_SESSION[$key] ?? $default;
    }

    public static function flash($key, $value): void
    {
        $_SESSION['_flash'][$key] = $value;
    }

    public static function unflash(): void
    {
        unset($_SESSION['_flash']);
    }

    public static function flush(): void
    {
        $_SESSION = [];
    }

    public static function destroy(): void
    {
        static::flush();
        session_destroy();

        $params = session_get_cookie_params();

        setcookie(session_name(), '', time() - 42000, $params['path'], $params['domain'], $params['secure'],
            $params['httponly']);
    }
}