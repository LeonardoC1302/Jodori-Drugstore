<?php
namespace Controllers;

use Model\Categorias;
use MVC\Router;
use Model\Producto;
use Model\Cart;
use Model\productsxcart;
use Model\Sale;
use Model\productsxsale;
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
        $cart = Cart::where('userId', $_SESSION['userId']);
        $productsXcart = productsxcart::whereAll('cartID', $cart->id);

        $result = $_GET['result'] ?? null;
        $error = $_GET['error'] ?? null;

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if($_POST['type'] === 'quitar'){
                $product = productsxcart::where('productID', $_POST['id']);
                if($product->quantity > 1){
                    $product->quantity -= 1;
                    $product->price -= Producto::find($_POST['id'])->price;
                    $product->guardar();
                } else{
                    $product->eliminar();
                }
                header('Location: /carrito');
            } else{
                $monto = 0;
                foreach($productsXcart as $productXcart){
                    $monto += $productXcart->price;
                }
                if($monto == 0){
                    header('Location: /carrito?error=2');
                }
                $sale = new Sale([
                    'description' => 'Venta de productos',
                    'monto' => $monto,
                    'discount' => 0,
                    'userId' => $_SESSION['userId']
                ]);
                $result = $sale->guardar();
                foreach($productsXcart as $product){
                    $productXsale = new productsxsale([
                        'salesID' => $result['id'],
                        'productID' => $product->productID,
                        'quantity' => $product->quantity,
                        'price' => $product->price
                    ]);
                    $productXsale->guardar();
                    $product->eliminar();
                }
                
                header('Location: /carrito?result=5');

            }
        }

        $categorias = Categorias::all();
        foreach($productsXcart as $productXcart){
            $product = Producto::find($productXcart->productID);
            $product->cantidad = $productXcart->quantity;
            $product->price = $productXcart->price;
            $productos[] = $product;
        }

        $router->render('pages/carrito', [
            'productos' => $productos,
            'categorias' => $categorias,
            'result' => $result,
            'error' => $error
        ]);
    }

    public static function productos(Router $router){
        $productos = Producto::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if(!isset($_SESSION['userId'])){
                header('Location: /login');
            }
            $cart = Cart::where('userId', $_SESSION['userId']);
            $products = productsxcart::whereAll('cartID', $cart->id);
            $exists = false;
            foreach($products as $product){
                if($product->productID == $_POST['producto']){
                    $product->quantity += 1;
                    $product->price += Producto::find($_POST['producto'])->price;
                    $product->guardar();
                    $exists = true;
                    break;
                }
            }
            if(!$exists){
                $productxcart = new productsxcart([
                    'cartID' => $cart->id,
                    'productID' => $_POST['producto'],
                    'quantity' => 1,
                    'price' => Producto::find($_POST['producto'])->price
                ]);
                $productxcart->guardar();
            }
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
            if(!isset($_SESSION['userId'])){
                header('Location: /login');
            }
            $cart = Cart::where('userId', $_SESSION['userId']);
            $products = productsxcart::whereAll('cartID', $cart->id);
            $exists = false;
            foreach($products as $product){
                if($product->productID == $_POST['producto']){
                    $product->quantity += 1;
                    $product->price += $product->price;
                    $product->guardar();
                    $exists = true;
                    break;
                }
            }
            if(!$exists){
                $productxcart = new productsxcart([
                    'cartID' => $cart->id,
                    'productID' => $_POST['producto'],
                    'quantity' => 1,
                    'price' => Producto::find($_POST['producto'])->price
                ]);
                $productxcart->guardar();
            }
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