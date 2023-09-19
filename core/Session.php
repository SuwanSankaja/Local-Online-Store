<?php

class Session {
    /**
     * If the session variable exists, return true, otherwise return false.
     *
     * @param string $name The name of the session variable you want to check.
     *
     * @return bool The value of the session variable.
     */
    public static function exists($name) {
        return isset($_SESSION[$name]);
    }

    /**
     * It returns the value of the session variable with the name $name.
     *
     * @param string $name The name of the session variable you want to get.
     *
     * @return boolean The value of the session variable with the name passed in.
     */
    public static function get($name) {
        return $_SESSION[$name];
    }

    /**
     * It sets a session variable
     *
     * @param string $name The name of the session variable you want to set.
     * @param string $value The value to store in the session.
     *
     * @return string The value of the session variable.
     */
    public static function set(string $name, string $value): string
    {
        return $_SESSION[$name] = $value;
    }

    /**
     * If the session exists, unset it.
     *
     * @param string $name The name of the session.
     */
    public static function delete($name) {
        if (self::exists($name)) {
            unset($_SESSION[$name]);
        }
    }

    /**
     * It takes the user agent string, and removes everything after the first slash
     *
     * @return array|string|string[] The user agent string without the version number.
     */
    public static function uagent_no_version() {
        $uagent = $_SERVER['HTTP_USER_AGENT'];
        $regx = '/\/[a-zA-Z0-9.]+/';
        return preg_replace($regx, '', $uagent);
    }
}