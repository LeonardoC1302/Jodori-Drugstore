<?php

namespace Controllers;
use MVC\Router;
use Model\Usuario;
use Classes\Email;

class LoginController {
    public static function index(Router $router){
        $alertas = [];

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario();
            $auth->sincronizar($_POST);
            $alertas = $auth->validateLogin();

            if(empty($alertas['error'])){
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
            'user' => $auth,
            'alertas' => $alertas
        ]);
    }

    public static function register(Router $router){
        $user = new Usuario();
        
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $user->sincronizar($_POST);
            $alertas = $user->validateRegister();
            if(empty($alertas['error'])){
                $result = $user->exists();
                if($result->num_rows){
                    $alertas = Usuario::getAlertas();
                } else{
                    $user->hashPassword();
                    $user->generateToken();

                    $email = new Email($user->email, $user->name, $user->token);
                    $email->sendConfirmation();

                    $result = $user->guardar();
                    if($result){
                        header('Location: /mensaje');
                    }
                }
            }
        }

        $router->render('auth/register', [
            'user' => $user,
            'alertas' => $alertas
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

    public static function verificar(Router $router){
        $alertas = [];
        $token= s($_GET['token'] ?? null);

        $user = Usuario::where('token', $token);
        if(empty($user)){
            Usuario::setAlerta('error', 'El token no es válido');
        } else{
            $user->verified = 1;
            $user->token = '';
            $user->guardar();
            Usuario::setAlerta('success', 'El usuario se verificó correctamente');
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/verificar', [
            'alertas' => $alertas
        ]);
    }

    public static function mensaje(Router $router){
        $router->render('auth/mensaje', [
        ]);
    }

    
}