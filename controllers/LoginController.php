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
                        $_SESSION['userId'] = $user->id;
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
        $alertas = [];
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $auth = new Usuario($_POST);
            $alertas = $auth->validateEmail();

            if(empty($alertas)){
                $user = Usuario::where('email', $auth->email);
                if($user && $user->verified === "1"){
                    $user->generateToken();
                    $user->guardar();

                    $mail = new Email($user->email, $user->name, $user->token);
                    $mail->sendRecover();

                    Usuario::setAlerta('success', 'Revisa tu correo para recuperar tu contraseña');
                } else{
                    Usuario::setAlerta('error', 'El usuario no existe o no está verificado');
                }
            }

        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/forgot', [
            'alertas' => $alertas
        ]);
    }

    public static function reset(Router $router){
        $error = false;
        $alertas = [];
        $token = s($_GET['token'] ?? null);
        $user = Usuario::where('token', $token);
        if(empty($user) || $token === ''){
            Usuario::setAlerta('error', 'Token Inválido');
            $error = true;
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            
            $password = new Usuario($_POST);
            $alertas = $password->comparePasswords($_POST['password'], $_POST['password2']);

            if(empty($alertas['error'])){
                $user->password = $password->password;
                $user->hashPassword();
                $user->token = '';
                $result = $user->guardar();
                if($result){
                    header('Location: /login');
                }
            }
        }

        $alertas = Usuario::getAlertas();
        $router->render('auth/reset', [
            'alertas' => $alertas,
            'error' => $error
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

    public static function logout(Router $router){
        session_start();
        $_SESSION = [];
        header('Location: /');
    }

    
}