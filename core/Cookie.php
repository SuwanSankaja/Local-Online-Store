<?php

class Cookie {
    public static function set($name, $value, $expiry): bool
    {
        if (setcookie($name, $value, time() + $expiry, '/')) {
            return true;
        }
        return false;
    }

    public static function delete($name): void
    {
        self::set($name, '', time() - 1);
    }

    public static function get($name) {
        return $_COOKIE[$name];
    }

    public static function exists(string $REMEMBER_ME_COOKIE_NAME): bool
    {
        return isset($_COOKIE[$REMEMBER_ME_COOKIE_NAME]);
    }
}