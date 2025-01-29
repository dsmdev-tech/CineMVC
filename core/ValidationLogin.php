<?php

namespace Core;

use App\Models\Customer;
use App\Models\Product;

class ValidationLogin
{
    private static function sanitizeInput($data): string
    {
        return htmlspecialchars(stripslashes(trim($data)));
    }

    public static function validate($email, $password)
    {
        $error = [];

        $user = self::sanitizeInput($email);
        if (empty($email)){
            $error["email"] = "* Debes introducir el usuario";
        }

        if (empty($password)){
            $error["password"] = "* Debes introducir la contraseña";
        }

        $user = Customer::findByEmail($email);

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION["username"] = $user['name'];
        } else {
            $error["login"] = "* El socio no está resgistrado o el usuario y la contraseña son incorrectas";
        }

        return $error;
    }
}