<?php

class Input
{
    public static function sanitize($dirty): string
    {
        return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
    }

    public static function exists($type = 'post'): bool
    {
        return match ($type) {
            'post' => !empty($_POST),
            'get' => !empty($_GET),
            default => false,
        };
    }

    public static function get($item): string
    {
        if (isset($_POST[$item])) {
            return self::sanitize($_POST[$item]);
        } else if (isset($_GET[$item])) {
            return self::sanitize($_GET[$item]);
        }
        return '';
    }
}
