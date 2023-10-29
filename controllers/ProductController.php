<?php

namespace Controllers;
use MVC\Router;
use Model\Producto;
use Model\Categorias;
use Intervention\Image\ImageManagerStatic as Image;

class ProductController {
    public static function index(Router $router){
        isAdmin();
        $productos = Producto::all();
        $router->render('admin/index', [
            'productos' => $productos
        ]);
    }

    public static function crear(Router $router){
        isAdmin();
        $producto = new Producto();
        $alerta = Producto::getAlertas();
        $categorias = Categorias::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $producto = new Producto($_POST);
            $imageName = md5(uniqid(rand(), true)) .  '.jpg';
            if($_FILES['imagen']){
                $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                $producto->setImage($imageName);
            }
            $alertas = $producto->validate();
            if(empty($alertas)){
                if(!is_dir(IMAGES_DIR)){
                    mkdir(IMAGES_DIR);
                }
                $image->save(IMAGES_DIR . $imageName);
                $producto->guardar();
                header('Location: /admin');
            }
        }
        $router->render('admin/crear', [
            'categorias' => $categorias,
            'alertas' => $alertas
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