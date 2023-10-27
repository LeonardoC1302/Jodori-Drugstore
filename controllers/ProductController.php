<?php

namespace Controllers;
use MVC\Router;
// Modelo de Producto (por hacer)
class ProductController {
    public static function index(Router $router){
        isAdmin();
        $router->render('admin/index', [
        ]);
    }

    public static function crear(Router $router){
        isAdmin();
        $router->render('admin/crear', [
        ]);
    }

    public static function actualizar(Router $router){
        isAdmin();
        $router->render('admin/actualizar', [
        ]);
    }

    public static function eliminar(Router $router){
        isAdmin();
        echo "Eliminar";
    }

    public static function reporte(Router $router){
        isAdmin();
        $router->render('admin/reporte', [
        ]);
    }
}