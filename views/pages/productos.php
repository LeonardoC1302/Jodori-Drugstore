<h1>Productos</h1>
<div class="products-list">
    <?php foreach($productos as $producto) { ?>
        <div class="product">
            <div class="product-image">
                <img src="/images/<?php echo $producto->imagen?>" alt="Imagen del Anuncio">
            </div>
            <p> <?php echo $producto->name; ?> </p>
            <p class="precio">₡<?php echo $producto->price; ?> I.V.A.I</p>
            <button class="cart-button" type="button" id="addToCartButton" data-product=<?php echo $producto->id; ?>>Agregar al Carrito</button>
        </div>
    <?php } ?>
</div>