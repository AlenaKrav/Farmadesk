<?php
$titulo = "Listado de consultas";
$pagina_activa = "consultas";
include("./templates/header.php");
?>

<div class="card">
    <div class="card-header">
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Email</th>
                        <th scope="col">Teléfono</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($consultas as $registro) { ?>
                        <tr class="">
                            <td><?php echo $registro->id ?></td>
                            <td><?php echo $registro->nombre ?></td>
                            <td><?php echo $registro->email ?></td>
                            <td><?php echo $registro->telefono ?></td>
                            <td><?php echo $registro->mensaje ?></td>
                            <td>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="consultas-formulario/borrar?id=<?php echo $registro->id; ?>" onclick="confirmarBorrado(event, <?php echo $registro->id; ?>)"><i class="fas fa-trash fa-sm"></i></a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
include("./templates/footer.php");
?>