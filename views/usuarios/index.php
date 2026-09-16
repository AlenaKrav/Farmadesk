<?php
$titulo = "Listado de usuarios";
$pagina_activa = "usuarios";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="usuarios/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir un nuevo usuario</a>
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
                        <th scope="col">Apellidos</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Tipo de usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($usuarios as $registro) { ?>
                        <tr class="">
                            <td><?php echo $registro->id; ?></td>
                            <td><?php echo $registro->nombre; ?></td>
                            <td><?php echo $registro->apellidos; ?></td>
                            <td><?php echo $registro->usuario; ?></td>
                            <td><?php echo $registro->correo; ?></td>
                            <td><?php echo $registro->role_nombre; ?></td>
                            <td>
                                <a name="editar" id="editar" class="btn btn-success btn-xs rounded-2" data-toggle="tooltip" title="Editar" href="usuarios/editar?id=<?php echo $registro->id ?>" role="button"><i class="fas fa-edit fa-sm"></i></a>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="usuarios/borrar?id=<?php echo $registro->id ?>" onclick="confirmarBorrado(event, <?php echo $registro->id; ?>)"><i class="fas fa-trash fa-sm"></i></a>
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