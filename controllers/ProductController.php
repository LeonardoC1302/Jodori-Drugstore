<?php

namespace Controllers;
use MVC\Router;
// Modelo de Producto (por hacer)
class ProductController {
    public static function index(Router $router){
        $router->render('admin/index', [
        ]);
    }

    public static function crear(Router $router){
        $router->render('admin/crear', [
        ]);
    }

    public static function actualizar(Router $router){
        $router->render('admin/actualizar', [
        ]);
    }

    public static function eliminar(Router $router){
        echo "Eliminar";
    }

    public static function reporte(Router $router){
        $router->render('admin/reporte', [
        ]);
    }
}