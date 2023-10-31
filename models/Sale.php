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

    public static function getDifference(){
        $currentMonth = date('n');

        $query = "SELECT COUNT(id) FROM " . static::$tabla . " WHERE MONTH(fecha) = " . $currentMonth;
        $result = self::$db->query($query);

        $query2 = "SELECT COUNT(id) FROM " . static::$tabla . " WHERE MONTH(fecha) = " . ($currentMonth - 1);
        $result2 = self::$db->query($query2);
        $dif = 0;
        try{
            $dif = intval($result->fetch_assoc()["COUNT(id)"]) - intval($result2->fetch_assoc()["COUNT(id)"]);
        } catch(\Exception $e){
            $dif = 0;
        }
        return $dif;
    }
}