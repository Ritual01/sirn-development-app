<h2>Registrar Muestra</h2>
<form action="index.php?c=Muestra&a=guardar" method="POST">
    Lugar: <input type="text" name="lugar" required><br>
    Fecha: <input type="date" name="fecha" required><br>
    Nivel de Cloro (mg/L): <input type="number" name="nivel_cloro" step="0.01" required><br>
    <input type="submit" value="Registrar">
</form>
