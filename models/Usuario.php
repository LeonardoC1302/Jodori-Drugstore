<?php

namespace Model;

class Usuario extends ActiveRecord{
    protected static $tabla = 'users';
    protected static $columnasDB = ['id', 'name', 'surname', 'username', 'email', 'password', 'admin', 'verified', 'token', 'phone'];

    public $id;
    public $name;
    public $surname;
    public $username;
    public $email;
    public $password;
    public $admin;
    public $verified;
    public $token;
    public $phone;

    public function __construct($args = []){
        $this->id = $args['userId'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->surname = $args['surname'] ?? '';
        $this->username = $args['username'] ?? '';
        $this->email = $args['email'] ?? '';
        $this->password = $args['password'] ?? '';
        $this->admin = $args['admin'] ?? 0;
        $this->verified = $args['verified'] ?? 0;
        $this->token = $args['token'] ?? '';
        $this->phone = $args['phone'] ?? '';
    }

    public function validateRegister(){
        if(!$this->name){
            self::setAlerta('error', 'El nombre es obligatorio');
        }
        if(!$this->surname){
            self::setAlerta('error', 'El apellido es obligatorio');
        }
        if(!$this->phone){
            self::setAlerta('error', 'El teléfono es obligatorio');
        }
        if(!$this->email){
            self::setAlerta('error', 'El email es obligatorio');
        }
        if(!$this->username){
            self::setAlerta('error', 'El nombre de usuario es obligatorio');
        }
        if(!$this->password){
            self::setAlerta('error', 'La contraseña es obligatoria');
        }

        return self::$alertas;
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

    public function exists(){
        $query = "SELECT * FROM " . self::$tabla . " WHERE email = '" . $this->email . "' LIMIT 1";
        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alertas['error'][] = 'El email ya está registrado';
        }

        $query = "SELECT * FROM " . self::$tabla . " WHERE username = '" . $this->username . "' LIMIT 1";
        $result = self::$db->query($query);

        if($result->num_rows) {
            self::$alertas['error'][] = 'El nombre de usuario ya está registrado';
        }

        return $result;
    }

    public function hashPassword() {
        $this->password = password_hash($this->password, PASSWORD_BCRYPT);
    }
    
    public function generateToken() {
        $this->token = uniqid();
    }
}