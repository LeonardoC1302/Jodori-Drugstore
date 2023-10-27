<?php 
namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'products';
    protected static $columnasDB = ['productID', 'name', 'description', 'price', 'cantidad', 'imagen'];

    public $productID;
    public $name;
    public $description;
    public $price;
    public $cantidad;
    public $imagen;

    public function __construct($args = []){
        $this->productID = $args['productID'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->cantidad = $args['cantidad'] ?? '';
        $this->imagen = $args['imagen'] ?? '';
    }

    public function validate(){
        if(!$this->name){
            self::setAlerta('error', 'El nombre es obligatorio');
        }
        if(!$this->description){
            self::setAlerta('error', 'La descripcion es obligatoria');
        }
        if(!$this->price){
            self::setAlerta('error', 'El precio es obligatorio');
        }
        if(!$this->cantidad){
            self::setAlerta('error', 'La cantidad es obligatoria');
        }
        if($this->cantidad && $this->cantidad <= 0){
            self::setAlerta('error', 'La cantidad debe ser mayor a 0');
        }
        if(!$this->imagen){
            self::setAlerta('error', 'La imagen es obligatoria');
        }

        return self::$alertas;
    }
}