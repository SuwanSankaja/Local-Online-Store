<?php

use JetBrains\PhpStorm\NoReturn;

class Router {
    public static function route($url): void
    {
        // controller
        $controller = (isset($url[0]) && $url[0] != '') ? ucwords($url[0]) : DEFAULT_CONTROLLER;
        $controller_name = $controller;

        array_shift($url);

        // action
        $action = (isset($url[0]) && $url[0] != '') ? $url[0] . 'Action' : 'indexAction';
        $action_name = $action;

        array_shift($url);

        // params
        $queryParams = $url;

        $dispatch = new $controller($controller_name, $action);

        if (method_exists($controller, $action)) {
            call_user_func_array([$dispatch, $action], $queryParams);
        } else {
            die('That method does not exist in the controller \"' . $controller_name . '\"');
        }
    }

    public static function redirect($location): void
    {
        if (!headers_sent()) {
            header('Location: ' . PROOT . $location);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . PROOT . $location . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . PROOT . $location . '" />';
            echo '</noscript>';
        }
        exit;
    }
}
