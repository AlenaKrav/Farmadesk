<?php
$titulo = "Listado de tareas";
$pagina_activa = "tareas";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base ?>admin/tareas/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir una nueva tarea</a>
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
                        <th scope="col">Descripción</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Usuario actualización</th>
                        <th scope="col">Fecha actulización</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($tareas as $registro) {
                        $estado = $registro->estado;
                        if ($estado == "Pendiente") {
                            $estadoClase = "estado-pendiente";
                        } elseif ($estado == "En proceso") {
                            $estadoClase = "estado-proceso";
                        } elseif ($estado == "Terminada") {
                            $estadoClase = "estado-terminado";
                        } else {
                            $estadoClase = "";
                        }
                    ?>
                        <tr class="">
                            <td><?php echo $registro->id; ?></td>
                            <td><?php echo $registro->nombre; ?></td>
                            <td><?php echo $registro->descripcion; ?></td>
                            <td><span class="<?php echo $estadoClase; ?>"><?php echo $estado; ?></span></td>
                            <td><?php echo $registro->fecha_creacion; ?></td>
                            <td><?php echo $registro->nombre_user_actualiza; ?></td>
                            <td><?php echo $registro->fecha_actualiza; ?></td>
                            <td>
                                <a name="editar" id="editar" class="btn btn-success btn-xs rounded-2" data-toggle="tooltip" title="Editar" href="tareas/editar?id=<?php echo $registro->id; ?>" role="button"><i class="fas fa-edit fa-sm"></i></a>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="tareas/borrar?id=<?php echo $registro->id; ?>" onclick="confirmarBorrado(event, <?php echo $registro->id; ?>)"><i class="fas fa-trash fa-sm"></i></a>
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