<?php

namespace Controllers;
use MVC\Router;

class LoginController {
    public static function index(Router $router){
        $router->render('auth/login', [
        ]);
    }

    public static function register(Router $router){
        $router->render('auth/register', [
        ]);
    }

    public static function forgot(Router $router){
        $router->render('auth/forgot', [
        ]);
    }

    public static function reset(Router $router){
        $router->render('auth/reset', [
        ]);
    }

    
}