<?php 
namespace Model;

class productsxsale extends ActiveRecord{
    protected static $tabla = 'productsxsale';
    protected static $columnasDB = ['id', 'salesID', 'productID', 'quantity', 'price'];

    public $id;
    public $salesID;
    public $productID;
    public $quantity;
    public $price;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->salesID = $args['salesID'] ?? '';
        $this->productID = $args['productID'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}