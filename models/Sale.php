<?php 
namespace Model;

class Sale extends ActiveRecord{
    protected static $tabla = 'sales';
    protected static $columnasDB = ['id', 'descripcion', 'monto', 'fecha', 'discount', 'userId'];

    public $id;
    public $descripcion;
    public $monto;
    public $fecha;
    public $discount;
    public $userId;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->descripcion = $args['description'] ?? '';
        $this->monto = $args['monto'] ?? '';
        $this->fecha = $args['fecha'] ?? date("Y-m-d H:i:s");
        $this->discount = $args['discount'] ?? '';
        $this->userId = $args['userId'] ?? null;
    }

    public function removeUser(){
        $query = "UPDATE " . static::$tabla . " SET userId = null WHERE id = " . $this->id;
        $result = self::$db->query($query);
        return $result;
    }
}