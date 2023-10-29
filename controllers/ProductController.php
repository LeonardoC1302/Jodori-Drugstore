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
        $id = validateORredirect('/admin');
        $producto = Producto::find($id);
        $alertas = Producto::getAlertas();

        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            debuguear($_POST);
        }

        $router->render('admin/actualizar', [
            'producto' => $producto,
            'alertas' => $alertas
        ]);
    }

    public static function eliminar(Router $router){
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            //debuguear($_POST['id']);
            $id = $_POST['id'];
            $producto = Producto::find($id); 
            $producto->eliminar();
        }
        //falta una confirmacion de eliminar producto
        header('Location: /admin');
    }

    public static function reporte(Router $router){
        isAdmin();
        $router->render('admin/reporte', [
        ]);
    }
}