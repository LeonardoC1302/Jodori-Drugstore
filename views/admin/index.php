<?php
    if($result){
        $message = showNotification(intval($result));
        if($message) { ?>
            <p class='alert success'> <?php echo s($message) ?> </p>;
        <?php }
    }
    if($error){
        $error = showErrors(intval($error));
        if($error) {?>
            <p class='alert error'> <?php echo s($error) ?> </p>;
        <?php }
    }
?>

<div class="actions">
    <a href="/admin/crear" class="orange-btn">Nuevo Producto</a>
    <a href="/admin/asignar" class="blue-btn">Asignar Admin.</a>
    <a href="/admin/reporte" class="orange-btn">Generar Reporte</a>
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
            <td>
                <?php foreach($categorias as $categoria){
                    if($categoria->id == $prod->categoryID){
                        echo $categoria->tipo;
                    }
                }
                ?>
            </td>
            <td>
                <form method="POST" class="w-100" action="/admin/eliminar">
                    <input type="hidden" name="id" value="<?php echo $prod->id ?>">
                    <input type="hidden" name="type" value="producto">
                    <input type="submit" class="icon-delete" value="&#128465;"onclick="return confirm('Está seguro que quiere eliminar este producto')">
                </form>
                <a href="/admin/actualizar?id=<?php echo $prod->id; ?>" class="icon-update">&#9998;</a>
            </td>
        </tr>
        <?php } ?>
    </tbody>
</table>