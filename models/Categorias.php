<?php 
namespace Model;

class Categorias extends ActiveRecord{
    protected static $tabla = 'categories';
    protected static $columnasDB = ['id', 'tipo'];

    public $id;
    public $tipo;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->tipo = $args['tipo'] ?? '';
    }
}