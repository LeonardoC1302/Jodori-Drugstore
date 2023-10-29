<?php 
namespace Model;

class Producto extends ActiveRecord{
    protected static $tabla = 'products';
    protected static $columnasDB = ['id', 'name', 'description', 'price', 'cantidad', 'imagen', 'categoryID'];

    public $id;
    public $name;
    public $description;
    public $price;
    public $cantidad;
    public $imagen;
    public $categoryID;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->name = $args['name'] ?? '';
        $this->description = $args['description'] ?? '';
        $this->price = $args['price'] ?? '';
        $this->cantidad = $args['cantidad'] ?? 0;
        $this->imagen = $args['imagen'] ?? '';
        $this->categoryID = $args['categoryID'] ?? null;
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
        if(!$this->imagen){
            self::setAlerta('error', 'La imagen es obligatoria');
        }
        if(!$this->categoryID){
            self::setAlerta('error', 'Debe escoger una categoria');
        }

        return self::$alertas;
    }

    public function validateCant(){
        if(!$this->cantidad){
            self::setAlerta('error', 'La cantidad es obligatoria');
        }
        if($this->cantidad && $this->cantidad <= 0){
            self::setAlerta('error', 'La cantidad debe ser mayor a 0');
        }
    }
}