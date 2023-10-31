<script src="https://code.highcharts.com/highcharts.js"></script>

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
        <p>Diferencia de Ventas <span>
            <?php 
            if($diferencia > 0 ){
                echo '+ ';
            } 
            echo $diferencia; 
            ?>
        </span></p>
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
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <div id="container" class="grafico-reporte"></div>

    <script>
        Highcharts.chart('container', {
            chart: {
                type: 'column'
            },
            title: {
                text: 'Resumen de Ventas 2023',
                style: {
                color: '#0833A2',
                fontFamily: 'League Gothic, sans-serif', // Cambia el tipo de letra
                fontWeight: 'bold', // Cambia el peso de la fuente
                fontSize: '22px' 
                }
            },
            xAxis: {
                labels: {
                    style: {
                        color: '#000000',
                        fontSize: '12px'
                    }
                },
                categories: [ 'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre' ],
                crosshair: true
            },
            yAxis: {
                min: 0,
                title: {
                    text: 'Monto (₡)',
                    style: {
                        color: '#000000',
                        fontSize: '12px'
                    }
                }
            },
            series: [{
                name: 'Ventas',
                color: '#FF6C00', // Cambia el color de las barras a rojo
                data: [
                    <?php
                    foreach ($data as $row) {
                        echo $row['total'] . ', ';
                    }
                    ?>
                ]
            }]
        });
    </script>

</div>
