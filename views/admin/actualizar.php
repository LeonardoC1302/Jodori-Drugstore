<?php 
    include_once __DIR__ . "/../templates/alerts.php";
?>
<h1>Actualizar Producto</h1>
<div class="create-form">
    <div class="flex">
        <a href="/admin" class="orange-btn">Volver al Panel</a>
    </div>

    <form method="POST" class="form" enctype="multipart/form-data">
        <div class="form__field">
            <label for="name" class="form__label">Nombre del Producto</label>
            <input class="form__input" type="name" placeholder="Nombre del Producto" id="name" name="name" value="<?php echo $producto->name;?>">
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="price" class="form__label">Precio</label>
            <input class="form__input" type="number" placeholder="Precio del Producto" id="price" name="price" value="<?php echo $producto->price;?>">
        </div> <!-- /form__field -->

        <div class="form__field">
            <label for="cantidad" class="form__label">Cantidad</label>
            <input class="form__input" type="number" placeholder="Cantidad del Producto" id="cantidad" name="cantidad" value="<?php echo $producto->cantidad;?>">
        </div> <!-- /form__field -->

        <div class="form__field">
            <label for="image" class="form__label">Imagen</label>
            <input class="form__input" type="file" id="imagen" name="imagen" accept="image/jpeg, image/png">
            <label class="form__label">Imagen Actual:</label>
            <img src="/images/<?php echo $producto->imagen;?>" class="image-small">
        </div> <!-- /form__field -->
        <div class="form__field">
            <legend class="form__legend">Categoría</legend>

            <select class="form__select" name="categoryID" id="categoryID"> <!-- Hacer un for para todas las categorías y poner en selected la que tenga el producto -->
                <option value="" disabled selected >-- Selecciona una Categoría --</option>
                <?php foreach($categorias as $cat){ ?>
                    <option value="<?php echo $cat->id ?>" > <?php echo $cat->tipo  ?> </option>
                    <?php } ?>
            </select>
            
        </div> <!-- /form__field -->
        <div class="form__field">
            <label for="description" class="form__label">Descripción</label>
            <textarea class="form__textarea" name="description" id="description" placeholder="Descripción del Producto"><?php echo$producto->description?>
            </textarea>
        </div> <!-- /form__field -->

        <input class="form__submit--orange" type="submit" value="Actualizar">
    </form>
</div>