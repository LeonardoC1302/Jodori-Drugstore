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
    <?php
    $mysqli = new mysqli("127.0.0.1", "root", "12345678", "farmacia_jodori");
    
    if ($mysqli->connect_error) {
        die("Error de conexión: " . $mysqli->connect_error);
    }
    ?>
    <?php
    $sql = "SELECT MONTHS.month AS mes, IFNULL(SUM(sales.monto), 0) AS total
            FROM (
            SELECT 1 AS month
            UNION SELECT 2
            UNION SELECT 3
            UNION SELECT 4
            UNION SELECT 5
            UNION SELECT 6
            UNION SELECT 7
            UNION SELECT 8
            UNION SELECT 9
            UNION SELECT 10
            UNION SELECT 11
            UNION SELECT 12
        ) AS MONTHS
        LEFT JOIN (
            SELECT MONTH(fecha) AS mes, SUM(monto) AS monto
            FROM sales
            WHERE YEAR(fecha) = 2023
            GROUP BY mes
        ) AS sales ON MONTHS.month = sales.mes
        GROUP BY MONTHS.month
        ORDER BY MONTHS.month";

    $result = $mysqli->query($sql);

    $data = array();
    while ($row = $result->fetch_assoc()) {
        $mes = $row['mes'];
        $total = $row['total'];

        $data[] = array("mes" => $mes, "total" => $total);
    }
    ?>
    
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <div id="container" style="width: 100%; height: 400px;"></div>

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
