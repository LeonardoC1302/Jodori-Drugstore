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


    public static function getMonthSales(){
        $query = "SELECT MONTHS.month AS mes, IFNULL(SUM(sales.monto), 0) AS total
            FROM (
            SELECT 1 AS month
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
            UNION SELECT 6
            UNION SELECT 7
            UNION SELECT 8
            UNION SELECT 9
            UNION SELECT 10
            UNION SELECT 11
            UNION SELECT 12
        ) AS MONTHS
        LEFT JOIN (
            SELECT MONTH(fecha) AS mes, SUM(monto) AS monto
            FROM sales
            WHERE YEAR(fecha) = 2023
            GROUP BY mes
        ) AS sales ON MONTHS.month = sales.mes
        GROUP BY MONTHS.month
        ORDER BY MONTHS.month";
        $result = self::$db->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $mes = $row['mes'];
            $total = $row['total'];

            $data[] = array("mes" => $mes, "total" => $total);
        }

        return $data;

    }
}