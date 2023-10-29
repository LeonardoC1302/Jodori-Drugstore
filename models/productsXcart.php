<?php 
namespace Model;

class productsxcart extends ActiveRecord{
    protected static $tabla = 'productsxcart';
    protected static $columnasDB = ['id', 'cartID', 'productID', 'quantity', 'price'];

    public $id;
    public $cartID;
    public $productID;
    public $quantity;
    public $price;

    public function __construct($args = []){
        $this->id = $args['id'] ?? null;
        $this->cartID = $args['cartID'] ?? '';
        $this->productID = $args['productID'] ?? '';
        $this->quantity = $args['quantity'] ?? '';
        $this->price = $args['price'] ?? '';
    }
}