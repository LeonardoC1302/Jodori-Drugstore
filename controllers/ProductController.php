<?php

namespace Controllers;
use MVC\Router;
use Model\Producto;
use Model\Categorias;
use Model\Usuario;
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
            if($_FILES['imagen']['tmp_name']){
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
            'alertas' => $alertas,
            'producto' => $producto
        ]);
    }

    public static function actualizar(Router $router){
        isAdmin();
        $id = validateORredirect('/admin');
        $producto = Producto::find($id);
        $alertas = Producto::getAlertas();
        $categorias = Categorias::all();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){

            $producto->sincronizar($_POST);
            if($_FILES['imagen']['name'] != ""){
                $imageName = md5(uniqid(rand(), true)) .  '.jpg';
                if($_FILES['imagen']){
                    $image = Image::make($_FILES['imagen']['tmp_name'])->fit(800, 600);
                    $producto->setImage($imageName);
                    if(!is_dir(IMAGES_DIR)){
                        mkdir(IMAGES_DIR);
                    }
                    $image->save(IMAGES_DIR . $imageName);
                }
            }
            
            $alertas = $producto->validate();
            $alertas = array_merge($alertas, $producto->validateCant());
            if(empty($alertas)){
                $producto->guardar();
                header('Location: /admin');
            }
        }

        $router->render('admin/actualizar', [
            'producto' => $producto,
            'alertas' => $alertas,
            'categorias' => $categorias
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
        header('Location: /admin');
    }

    public static function asignar(Router $router){
        isAdmin();
        $current = $_SESSION['userId'];
        $usuarios = Usuario::all();
        $router->render('admin/asignar', [
            'usuarios' => $usuarios,
            'current' => $current
        ]);
    }

    public static function asignarAdmin(Router $router){
        isAdmin();
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $id = $_POST['id'];
            $usuario = Usuario::find($id); 
            $usuario->sincronizar($_POST);
            $usuario->guardar();
        }
        header('Location: /admin/asignar');
    }

    public static function reporte(Router $router){
        isAdmin();
        $router->render('admin/reporte', [
        ]);
    }
}