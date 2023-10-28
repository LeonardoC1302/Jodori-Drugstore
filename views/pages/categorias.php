<h1>Categorías</h1>
<div class="categorias">
    <div class="categoria">
        <div class="cuidado-personal"></div>
        <p>Cuidado Personal</p>
    </div>
    <div class="categoria">
        <div class="dermatologia"></div>
        <p>Dermatología</p>
    </div>
    <div class="categoria">
        <div class="tos-y-flema"></div>
        <p>Tos y Flema</p>
    </div>
    <div class="categoria">
        <div class="anticonceptivos"></div>
        <p>Anticonceptivos</p>
    </div>
    <div class="categoria">
        <div class="vitaminas"></div>
        <p>Vitaminas</p>
    </div>
    <div class="categoria">
        <div class="niños"></div>
        <p>Niños</p>
    </div>
</div>
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