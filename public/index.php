<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PagesController;
use Controllers\LoginController;

$router = new Router();


$router->get('/', [PagesController::class, 'index']);


$router->get('/login', [LoginController::class, 'index']);
$router->get('/register', [LoginController::class, 'register']);
$router->get('/forgot', [LoginController::class, 'forgot']);
$router->get('/reset', [LoginController::class, 'reset']);

$router->get('/carrito', [PagesController::class, 'carrito']);
$router->get('/productos', [PagesController::class, 'productos']);
$router->get('/categorias', [PagesController::class, 'categorias']);
$router->get('/contacto', [PagesController::class, 'contacto']);



 
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();