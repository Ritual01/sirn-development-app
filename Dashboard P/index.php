<?php
include 'includes/header.php';
include 'db.php';

// Consulta para obtener todos los registros (ajusta los campos según tu tabla)
$sql = "SELECT * FROM analisis ORDER BY fecha_analisis DESC LIMIT 10";
$resultados = get_data($sql);

// Obtener los últimos 7 días para el gráfico semanal
$fecha_actual = date('Y-m-d');
$fecha_inicio = date('Y-m-d', strtotime('-7 days'));
$sql_semanal = "SELECT muestra_id, fecha_analisis FROM analisis WHERE fecha_analisis BETWEEN '$fecha_inicio' AND '$fecha_actual'";
$resultados_semanales = get_data($sql_semanal);

// Manejo de errores para depuración
if (!$resultados) {
    die("Error en la consulta de registros: " . $conn->error);
}
if (!$resultados_semanales) {
    die("Error en la consulta semanal: " . $conn->error);
}

// Mensaje de conexión exitosa
echo '<div class="alert-success">Conexión exitosa a la base de datos <b>Railway</b>.</div>';
?>

<h2>Monitoreo de Calidad del Agua</h2>

<div class="alert alert-info">
    Última actualización: <?php echo $fecha_actual; ?>
</div>

<h3>Últimos Registros</h3>
<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Muestra ID</th>
            <th>Fecha de Análisis</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($fila = $resultados->fetch_assoc()): ?>
        <tr>
            <td><?php echo htmlspecialchars($fila['id']); ?></td>
            <td><?php echo htmlspecialchars($fila['muestra_id']); ?></td>
            <td><?php echo htmlspecialchars($fila['fecha_analisis']); ?></td>
        </tr>
        <?php endwhile; ?>
    </tbody>
</table>

<h3>Gráfico Semanal de Muestras</h3>
<canvas id="graficoCloro" width="400" height="200"></canvas>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script> 
<script>
const ctx = document.getElementById('graficoCloro').getContext('2d');
const grafico = new Chart(ctx, {
    type: 'line',
    data: {
        labels: [<?php 
            $resultados_semanales->data_seek(0);
            while ($fila = $resultados_semanales->fetch_assoc()) {
                echo '"' . $fila['fecha_analisis'] . '",';
            }
        ?>],
        datasets: [{
            label: 'Muestra ID',
            data: [<?php 
                $resultados_semanales->data_seek(0); // Reiniciar puntero
                while ($fila = $resultados_semanales->fetch_assoc()) {
                    echo '"' . $fila['muestra_id'] . '",';
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
