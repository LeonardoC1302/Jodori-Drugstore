<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Farmacia Jodori</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700;900&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/build/css/app.css">
</head>
<body>
    <header class="header section">
        <a href="/" class="logo">
            <p>Farmacia</p>
            <p><span>Jodori</span></p>
        </a>
        <form class="search-bar">
            <div class="buscador">
                <input type="text" name="search" placeholder="Buscar Producto">
                <button class="search-button" type="submit"></button>
            </div>
        </form>

        <div class="actions">
            <?php if(!isset($_SESSION['login'])) { ?>
                <a class="login" href="login">Iniciar Sesión</a>
                <?php } else { ?>
                    <a class="login" href="logout">Cerrar Sesión</a>
                    <a class="login" href="cuenta">Mi Cuenta</a>
                    <a class="carrito" href="carrito"> </a>
            <?php } ?>
        </div>
    </header>

    <nav class="navegacion">
        <a <?php if ($page == 'inicio') { echo 'class="active"'; } ?> href="/">
        Inicio</a>
        <a <?php if ($page == 'productos') { echo 'class="active"'; } ?> href="productos">
        Productos</a>
        <a <?php if ($page == 'categorias') { echo 'class="active"'; } ?> href="categorias">
        Categorías</a>
        <a <?php if ($page == 'contacto') { echo 'class="active"'; } ?> href="contacto">
        Contacto</a>
    </nav>

    <?php echo $contenido; ?>

    <footer class="footer section">
        <div class="container footer-content">
            <p class="copyright">Farmacia Jodori &copy. Todos los derechos reservados.</p>
        </div>
    </footer>
    
    <script src='build/js/app.js'></script>
</body>
</html>