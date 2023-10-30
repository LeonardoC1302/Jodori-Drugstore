<div class="datos">
    <div class="dato">
        <p>Productos en Inventario <span><?php echo count($products); ?></span></p>
    </div>

    <div class="dato">
        <p>Clientes Registrados <span><?php echo count($users); ?></span></p>
    </div>

    <div class="dato">
        <p>Total de Ventas <span><?php echo count($sales); ?></span></p>
    </div>

    <div class="dato">
        <p>Diferencia de Ventas <span>+10</span></p>
    </div>

    <div class="dato">
        <p>Ganancias Totales <span>₡
            <?php
                $total = 0;
                foreach($sales as $sale){
                    $total += $sale->monto;
                }
                echo $total;
            ?>
        </span></p>
    </div>
</div>

<div class="reporte">
    <h1 class="align-left">Resumen de Ventas/Ganancias</h1>
    <div class="grafico">
        <img src="/images/grafico.jpg" alt="Imagen Gráfico">
        <a class="orange-btn" href="/admin">Volver al panel</a>
    </div>
</div>