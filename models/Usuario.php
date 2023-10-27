<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'users';
    protected static $columnasDB = ['userId', 'name', 'surname', 'username', 'email', 'password', 'admin', 'verified', 'token'];

    public $userId;
    public $name;
    public $surname;
    public $username;
    public $email;
    public $password;
    public $admin;
    public $verified;
    public $token;

    public function __construct($args = []){
        $this->userId = $args['userId'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verified = $args['verified'] ?? 0;
        $this->token = $args['token'] ?? '';
    }

    public function validateLogin(){
        if(!$this->email){
            self::setAlerta('error', 'El email es obligatorio');
        }else if(!filter_var($this->email, FILTER_VALIDATE_EMAIL)){
            self::setAlerta('error', 'El email es inválido');
        }

        if(!$this->password){
            self::setAlerta('error', 'La contraseña es obligatoria');
        }

        return self::$alertas;
    }

    public function verificarPassword($password){
        $result = password_verify($password, $this->password);
        
        if(!$result || !$this->verified){
            self::$alertas['error'][] = 'La contraseña es incorrecta o el usuario no está verificado';
        } else {
            return true;
        }
    }
}