<footer class="bg-dark text-white text-center py-4 mt-5">
    <div class="container">
        <p class="mb-1">&copy; <?php echo date('Y'); ?> Sistema de Monitoreo de Agua</p>
        <small>Desarrollado por TuNombre - Todos los derechos reservados</small>
        <!-- Íconos sociales opcionales -->
        <div class="mt-2">
            <a href="#" class="text-white me-2"><i class="bi bi-facebook"></i></a>
            <a href="#" class="text-white me-2"><i class="bi bi-twitter-x"></i></a>
            <a href="#" class="text-white"><i class="bi bi-github"></i></a>
        </div>
    </div>
</footer>

<!-- AOS Animations -->
<script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
<script>
    AOS.init();
</script>

<!-- jQuery (requerido por DataTables) -->
<script src="https://cdn.jsdelivr.net/npm/jquery@3.7.1/dist/jquery.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Activar DataTable -->
<script>
    $(document).ready(function () {
        $('#tablaRegistros').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>

<!-- Bootstrap Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
