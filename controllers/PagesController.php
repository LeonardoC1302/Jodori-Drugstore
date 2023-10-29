<?php
namespace Controllers;

use Model\Categorias;
use MVC\Router;
use Model\Producto;
use Model\Cart;
use Model\productsxcart;
use Model\Usuario;


class PagesController {
    public static function index(Router $router){
        $productos = Producto::get(3);
        $router->render('pages/index', [
            'productos' => $productos,
            'page' => 'inicio'
        ]);
    }

    public static function carrito(Router $router){
        $productos = [];
        foreach($_SESSION['products'] as $product){
            $producto = Producto::find($product);
            $producto->cantidad = 1;
            if(inArray($producto, $productos)){
                $index = array_search($producto, $productos);
                $cantidad = $productos[$index]->cantidad;
                $productos[$index]->cantidad = $cantidad+1;
            }else{
                $productos[] = $producto;
            }
        }

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['type'] === 'quitar'){
                $productos = $_SESSION['products'];
                foreach($productos as $producto){
                    if($producto === $_POST['id']){
                        $index = array_search($producto, $productos);
                        unset($productos[$index]);
                        break;
                    }
                }
                $_SESSION['products'] = $productos;
                header('Location: /carrito');
            } else{
                if(empty($_SESSION['products'])){
                    header('Location: /carrito');
                }
                $cart = new Cart($_SESSION);
                $id = $cart->guardar()['id'];
                foreach($productos as $producto){
                    $productxcart = new productsxcart([
                        'cartID' => $id,
                        'productID' => $producto->id,
                        'quantity' => $producto->cantidad,
                        'price' => $producto->price * $producto->cantidad
                    ]);
                    $productxcart->guardar();
                }
                $_SESSION['products'] = [];
                header('Location: /');

            }
        }

        $categorias = Categorias::all();

        $router->render('pages/carrito', [
            'productos' => $productos,
            'categorias' => $categorias
        ]);
    }

    public static function productos(Router $router){
        $productos = Producto::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            // only add if the product is not already in the cart
            array_push($_SESSION['products'], $_POST['producto']);
            header('Location: /productos');
        }
        $router->render('pages/productos', [
            'productos' => $productos,
            'page' => 'productos'
        ]);
    }

    public static function categorias(Router $router){
        $productos = Producto::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            array_push($_SESSION['products'], $_POST['producto']);
            header('Location: /categorias');
        }
        $router->render('pages/categorias', [
            'productos' => $productos,
            'page' => 'categorias'
        ]);
    }

    public static function contacto(Router $router){
        $router->render('pages/contacto', [
            'page' => 'contacto'
        ]);
    }
}