<?php

function dnd($data): void
{
    echo '<pre>';
    var_dump($data);
    echo '</pre>';
    die();
}

function sanitize($dirty): string
{
    return htmlentities($dirty, ENT_QUOTES, 'UTF-8');
}

function currentLoggedInUser() {
    return Customer::currentLoggedInUser();
}
