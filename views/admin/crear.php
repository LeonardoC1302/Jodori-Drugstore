<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>

<h1>Crear Producto</h1>
<div class="create-form">
    <div class="flex">
        <a href="/admin" class="orange-btn">Volver al Panel</a>
    </div>

    <form class="form" method="POST" enctype="multipart/form-data">
        <div class="form__field">
            <label for="name" class="form__label">Nombre del Producto</label>
            <input class="form__input" type="name" placeholder="Nombre del Producto" id="name" name="name">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="price" class="form__label">Precio</label>
            <input class="form__input" type="number" placeholder="Precio del Producto" id="price" name="price">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="imagen" class="form__label">Imagen</label>
            <input class="form__input" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
        </div> <!-- /form__field -->
        <div class="form__field">
            <legend class="form__legend">Categoría</legend>
            <select class="form__select" name="categoryID" id="categoryID">
                <option value="" disabled selected>-- Selecciona una Categoría --</option>
                <?php foreach($categorias as $cat){ ?>
                    <option value="<?php echo $cat->id ?>" > <?php echo $cat->tipo  ?> </option>
                    <?php } ?>
            </select>
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="description" class="form__label">Descripción</label>
            <textarea class="form__textarea" name="description" id="description" placeholder="Descripción del Producto"></textarea>
        </div> <!-- /form__field -->

        <input class="form__submit--orange" type="submit" value="Crear">
    </form>
</div>