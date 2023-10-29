<div class="actions">
    <a href="/admin/crear" class="orange-btn">Nuevo Producto</a>
    <a href="/admin/reporte" class="blue-btn">Generar Reporte</a>
</div>

<h1>Productos</h1>
<table class="products">
    <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Imagen</th>
            <th>Precio</th>
            <th>Cantidad</th>
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <?php foreach ($productos as $prod){?>  
        <tr>
            <td><?php echo $prod->id ?></td>
            <td><?php echo $prod->name ?></td>
            <td><img src="/images/<?php echo $prod->imagen ?>" alt="Table Image" class="table-image"></td>
            <td>₡<?php echo $prod->price ?></td>
            <td> <?php echo $prod->cantidad ?> </td>
            <td><?php echo $prod->categoryID ?></td>
            <td>
                <form method="POST" class="w-100" action="/admin/eliminar">
                    <input type="hidden" name="id" value="<?php echo $prod->id ?>">
                    <input type="hidden" name="type" value="producto">
                    <input type="submit" class="red-btn-block" value="Eliminar">
                </form>
                <a href="/admin/actualizar?id=<?php echo $prod->id; ?>" class="blue-btn">Actualizar</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>