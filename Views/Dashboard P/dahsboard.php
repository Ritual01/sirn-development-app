<?php
include 'includes/header.php';
include 'db.php';

$fecha_actual = date('Y-m-d');
$fecha_inicio = date('Y-m-d', strtotime('-7 days'));

$sql = "SELECT * FROM analisis ORDER BY fecha_analisis DESC LIMIT 10";
$resultados = get_data($sql);

$sql_semanal = "SELECT muestra_id, fecha_analisis FROM analisis WHERE fecha_analisis BETWEEN '$fecha_inicio' AND '$fecha_actual'";
$resultados_semanales = get_data($sql_semanal);

if (!$resultados || !$resultados_semanales) {
    die("Error en la consulta: " . $conn->error);
}
?>

<div class="container my-4">
    <div class="text-center mb-4" data-aos="fade-down">
        <h2 class="titulo">Monitoreo de Calidad del Agua</h2>
        <div class="alert alert-success mt-3 mx-auto" style="max-width: 600px;">
            Conexión exitosa a la base de datos <b>Railway</b>.
        </div>
        <div class="alert alert-info mt-3 mx-auto" style="max-width: 600px;">
            Última actualización: <?php echo $fecha_actual; ?>
        </div>
    </div>

    <div class="card p-3 shadow" data-aos="fade-up">
        <h3 class="text-center mb-3">Últimos Registros</h3>
        <div class="table-responsive">
            <table id="tablaRegistros" class="table table-bordered table-striped table-hover">
                <thead class="table-primary">
                    <tr>
                        <th>ID</th>
                        <th>Muestra ID</th>
                        <th>Fecha de Análisis</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($fila = $resultados->fetch_assoc()): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['id']) ?></td>
                            <td><?= htmlspecialchars($fila['muestra_id']) ?></td>
                            <td><?= htmlspecialchars($fila['fecha_analisis']) ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>

    <div class="card mt-5 p-4 shadow" data-aos="zoom-in">
        <h3 class="text-center mb-3">Gráfico Semanal de Muestras</h3>
        <canvas id="graficoCloro" height="160"></canvas>
    </div>
</div>

<!-- Cargar Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('graficoCloro').getContext('2d');
    const grafico = new Chart(ctx, {
        type: 'line',
        data: {
            labels: [<?php 
                $fechas = [];
                $niveles = [];
                $resultados_semanales->data_seek(0);
                while ($fila = $resultados_semanales->fetch_assoc()) {
                    $fechas[] = '"' . $fila['fecha_analisis'] . '"';
                    $niveles[] = $fila['muestra_id'];
                }
                echo implode(",", $fechas);
            ?>],
            datasets: [{
                label: 'Muestra ID',
                data: [<?php echo implode(",", $niveles); ?>],
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: true,
                tension: 0.3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                title: {
                    display: true,
                    text: 'Tendencia del Nivel de Cloro'
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'ID de Muestra'
                    }
                },
                x: {
                    title: {
                        display: true,
                        text: 'Fecha de Análisis'
                    }
                }
            }
        }
    });
</script>

<?php include 'includes/footer.php'; ?>
