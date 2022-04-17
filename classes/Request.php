<?php

namespace Project\Classes;

class Request
{
    public function get($key)
    {
        return $_GET[$key];
    }

    public function getHas(string $key): bool
    {
        return isset($_GET[$key]);
    }

    public function post($key)
    {
        return $_POST[$key];
    }

    public function postHas(string $key): bool
    {
        return isset($_POST[$key]);
    }
    public function postClean($key)
    {
        return trim(htmlspecialchars($_POST[$key]));
    }
    public function files($key)
    {
        return $_FILES[$key];
    }
    public function redirect($path)
    {
        header('location:' . URL . $path);
    }
}