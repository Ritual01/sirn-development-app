<?php
include 'includes/header.php';
include 'db.php';

// Consulta para obtener todos los registros
$sql = "SELECT * FROM tu_tabla ORDER BY fecha DESC LIMIT 10";
$resultados = get_data($sql);

// Obtener los últimos 7 días para el gráfico semanal
$fecha_actual = date('Y-m-d');
$fecha_inicio = date('Y-m-d', strtotime('-7 days'));
$sql_semanal = "SELECT lugar, nivel_cloro, fecha FROM tu_tabla WHERE fecha BETWEEN '$fecha_inicio' AND '$fecha_actual'";
$resultados_semanales = get_data($sql_semanal);
?>

<h2>Monitoreo de Calidad del Agua</h2>

<div class="alert alert-info">
    Última actualización: <?php echo $fecha_actual; ?>
</div>

<h3>Últimos Registros</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>Lugar</th>
            <th>Fecha</th>
            <th>Nivel de Cloro</th>
            <th>Turbidez</th>
            <th>pH</th>
            <th>Usuario</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultados->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($fila['lugar']); ?></td>
            <td><?php echo htmlspecialchars($fila['fecha']); ?></td>
            <td><?php echo htmlspecialchars($fila['nivel_cloro']); ?> mg/L</td>
            <td><?php echo htmlspecialchars($fila['turbidez']); ?> NTU</td>
            <td><?php echo htmlspecialchars($fila['ph']); ?></td>
            <td><?php echo htmlspecialchars($fila['usuario_nombre']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h3>Gráfico Semanal de Nivel de Cloro</h3>
<canvas id="graficoCloro"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
<script>
const ctx = document.getElementById('graficoCloro').getContext('2d');
const grafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php 
            while ($fila = $resultados_semanales->fetch_assoc()) {
                echo '"' + $fila['fecha'] + '",';
            }
        ?>],
        datasets: [{
            label: 'Nivel de Cloro (mg/L)',
            data: [<?php 
                $resultados_semanales->data_seek(0); // Reiniciar puntero
                while ($fila = $resultados_semanales->fetch_assoc()) {
                    echo $fila['nivel_cloro'] + ',';
                }
            ?>],
            borderColor: 'blue',
            fill: false
        }]
    },
    options: {
        scales: {
            y: { beginAtZero: true }
        }
    }
});
</script>

<?php include 'includes/footer.php'; ?>