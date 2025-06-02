<h2>Últimos Análisis de Cloro Residual</h2>
<table border="1">
    <tr><th>Lugar</th><th>Fecha</th><th>Nivel de Cloro (mg/L)</th></tr>
    <?php foreach ($datos as $fila): ?>
    <tr>
        <td><?= htmlspecialchars($fila['lugar']) ?></td>
        <td><?= htmlspecialchars($fila['fecha']) ?></td>
        <td><?= htmlspecialchars($fila['nivel_cloro']) ?></td>
    </tr>
    <?php endforeach; ?>
</table>
