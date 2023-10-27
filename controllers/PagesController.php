<?php
namespace Controllers;

use MVC\Router;
use Model\Producto;
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
        $router->render('pages/carrito', [
        ]);
    }

    public static function productos(Router $router){
        $productos = Producto::all();
        $router->render('pages/productos', [
            'productos' => $productos,
            'page' => 'productos'
        ]);
    }

    public static function categorias(Router $router){
        $router->render('pages/categorias', [
            'page' => 'categorias'
        ]);
    }

    public static function contacto(Router $router){
        $router->render('pages/contacto', [
            'page' => 'contacto'
        ]);
    }

    public static function cuenta(Router $router){
        isAuth();
        $id = $_SESSION['userId'];
        $user = Usuario::find($id);

        $router->render('pages/cuenta', [
            'user' => $user,
        ]);
    }


    
}