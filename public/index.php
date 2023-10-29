<?php 

require_once __DIR__ . '/../includes/app.php';

use MVC\Router;
use Controllers\PagesController;
use Controllers\LoginController;
use Controllers\ProductController;

$router = new Router();


$router->get('/', [PagesController::class, 'index']);


$router->get('/login', [LoginController::class, 'index']);
$router->post('/login', [LoginController::class, 'index']);

$router->get('/logout', [LoginController::class, 'logout']);

$router->get('/mensaje', [LoginController::class, 'mensaje']);
$router->get('/verificar', [LoginController::class, 'verificar']);

$router->get('/register', [LoginController::class, 'register']);
$router->post('/register', [LoginController::class, 'register']);

$router->get('/forgot', [LoginController::class, 'forgot']);
$router->post('/forgot', [LoginController::class, 'forgot']);

$router->get('/reset', [LoginController::class, 'reset']);
$router->post('/reset', [LoginController::class, 'reset']);

$router->get('/cuenta', [LoginController::class, 'cuenta']);

$router->get('/cuenta/actualizar', [LoginController::class, 'actualizarCuenta']);
$router->post('/cuenta/actualizar', [LoginController::class, 'actualizarCuenta']);

$router->get('/cuenta/eliminar', [LoginController::class, 'eliminarCuenta']);

$router->get('/carrito', [PagesController::class, 'carrito']);
$router->get('/productos', [PagesController::class, 'productos']);
$router->get('/categorias', [PagesController::class, 'categorias']);
$router->get('/contacto', [PagesController::class, 'contacto']);

// Admin
$router->get('/admin', [ProductController::class, 'index']);
$router->get('/admin/crear', [ProductController::class, 'crear']);

$router->post('/admin/crear', [ProductController::class, 'crear']);

$router->get('/admin/actualizar', [ProductController::class, 'actualizar']);

$router->get('/admin/eliminar', [ProductController::class, 'eliminar']);
$router->post('/admin/eliminar', [ProductController::class, 'eliminar']);

$router->get('/admin/reporte', [ProductController::class, 'reporte']);


// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();