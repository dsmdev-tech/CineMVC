<?php

namespace Core;

class App
{
    function __construct()
    {
        if (isset($_GET['url'])) {
            $url = $_GET['url'];
        } else {
            $url = 'user';
        }

        $arguments = explode('/' , trim($url, '/'));
        $controllerName = array_shift($arguments);
        $controllerName = ucwords($controllerName) . "Controller";

        if (count($arguments)){
            $method = array_shift($arguments);
        } else {
            $method = "login";
        }


        $file = "../app/controllers/$controllerName" . ".php";
        if (file_exists($file)) {
            require_once $file;
        } else {
            echo "No encontrado el controlador";
            die();
        }

        $namespace = "App\\Controllers\\";
        $controllerClass = $namespace . $controllerName;

        $controllerObject = new $controllerClass;
        if (method_exists($controllerClass, $method)) {
            // call_user_func_array([$controllerObject, $method], $arguments);
            $controllerObject->$method(...$arguments);
            //$controllerObject->$method($arguments);
        } else {
            echo "No encontrado el método";
            die();
        }
    }
}

