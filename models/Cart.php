<?php 
namespace Model;

class Cart extends ActiveRecord{
    protected static $tabla = 'cart';
    protected static $columnasDB = ['id', 'userId', 'active'];

    public $id;
    public $userId;
    public $active;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->userId = $args['userId'] ?? '';
        $this->active = $args['active'] ?? 1;
    }
}