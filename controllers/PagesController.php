<?php
namespace Controllers;

use MVC\Router;


class PagesController {
    public static function index(Router $router){
        $router->render('pages/index', [
            'page' => 'inicio'
        ]);
    }

    public static function carrito(Router $router){
        $router->render('pages/carrito', [
        ]);
    }

    public static function productos(Router $router){
        $router->render('pages/productos', [
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
        $router->render('pages/cuenta', [
        ]);
    }


    
}