<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;

class LoginController {
    public static function index(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario();
            $auth->sincronizar($_POST);
            $alertas = $auth->validateLogin();

            if(empty($alertas)){
                $user = Usuario::where('email', $auth->email);
                if($user){
                    if($user->verificarPassword($auth->password)){
                        session_start();
                        $_SESSION['userId'] = $user->userId;
                        $_SESSION['username'] = $user->username;
                        $_SESSION['email'] = $user->email;
                        $_SESSION['login'] = true;

                        if($user->admin == 1){
                            $_SESSION['admin'] = true;
                            header('Location: /admin');
                        } else{
                            header('Location: /');
                        }
                    }
                } else{
                    Usuario::setAlerta('error', 'El usuario no existe');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/login', [
            'alertas' => $alertas
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