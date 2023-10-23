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
            <th>Categoría</th>
            <th>Acciones</th>
        </tr>
    </thead>

    <tbody>
        <!-- Meterlo en un for -->
        <tr>
            <td>1</td>
            <td>Abrilar 100ml Jarabe Via Oral</td>
            <td><img src="/images/abrilar.jpg" alt="Table Image" class="table-image"></td>
            <td>₡5.300</td>
            <td>Asma y Alergias</td>
            <td>
                <form method="POST" class="w-100" action="/admin/eliminar">
                    <input type="hidden" name="id" value="1">
                    <input type="hidden" name="type" value="producto">
                    <input type="submit" class="red-btn-block" value="Eliminar">
                </form>
                <a href="/admin/actualizar" class="blue-btn">Actualizar</a>
            </td>
        </tr>
        <!-- Hasta acá -->

        <!-- Meterlo en un for -->
        <tr>
            <td>2</td>
            <td>Cataflam D. 46.5mg Tableta Vía Oral</td>
            <td><img src="/images/cataflam.jpg" alt="Table Image" class="table-image"></td>
            <td>₡1.055</td>
            <td>Dolor e Inflamación</td>
            <td>
                <form method="POST" class="w-100" action="/admin/eliminar">
                    <input type="hidden" name="id" value="2">
                    <input type="hidden" name="type" value="producto">
                    <input type="submit" class="red-btn-block" value="Eliminar">
                </form>
                <a href="/admin/actualizar" class="blue-btn">Actualizar</a>
            </td>
        </tr>
        <!-- Hasta acá -->

    </tbody>

</table>