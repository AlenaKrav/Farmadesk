</main>
<footer>
</footer>
<!-- DataTables -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<!-- Estilos Responsive -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/3.0.1/css/responsive.dataTables.min.css" />
<!-- Script Responsive -->
<script type="text/javascript" src="https://cdn.datatables.net/responsive/3.0.1/js/dataTables.responsive.min.js"></script>
<!-- Bootstrap JavaScript Libraries -->
<script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

<script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
<script>
    let table = new DataTable('table', {
        responsive: true,
        autoFill: true,
        "language": {
            "url": 'https://cdn.datatables.net/plug-ins/2.2.2/i18n/es-ES.json',
        }

    });
    table.on('autoFill', function() {
        table.columns.adjust();
    });
</script>
<!-- Script con ConfirmarBorrado -->
<script src="<?php echo $url_base; ?>assets/js/myscript.js"></script>
<!-- Script con sugerencias -->
<script src="<?php echo $url_base; ?>assets/js/sugerencias.js"></script>
<script>
    $(function() {
        $('[data-toggle="tooltip"]').tooltip();
    });
</script>
</body>

</html>