<?php
$titulo = "Listado de recetas";
$pagina_activa = "recetas";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base ?>admin/recetas/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir una nueva receta</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Id Receta</th>
                        <th scope="col">Datos del paciente</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre fármaco</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Código nacional</th>
                        <th scope="col">Observaciones</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recetas as $registro): ?>
                        <?php
                        $estado = $registro->estado;
                        if ($estado == "Enviada") {
                            $estadoClase = "estado-enviada";
                        } elseif ($estado == "En proceso") {
                            $estadoClase = "estado-proceso";
                        } elseif ($estado == "Completada") {
                            $estadoClase = "estado-terminado";
                        } elseif ($estado == "Rechazada") {
                            $estadoClase = "estado-rechazado";
                        } else {
                            $estadoClase = "";
                        }
                        ?>
                        <tr class="">
                            <td><?php echo $registro->id_receta ?></td>
                            <td><?php echo $registro->nombre_completo_paciente ?></td>

                            <td>
                                <a href="<?php echo $url_base; ?>assets/img/recetas/<?php echo $registro->imagen_receta; ?>" target="_blank" title="Ver imagen en tamaño completo">
                                    <img class="clickable" src="<?php echo $url_base; ?>assets/img/recetas/<?php echo $registro->imagen_receta; ?>" />
                            <td><?php echo $registro->nombre ?></td>
                            <td><?php echo $registro->fecha ?></td>
                            <td><span class="<?php echo $estadoClase; ?>"><?php echo $estado; ?></span></td>
                            <td><?php echo $registro->codigo_nacional ?></td>
                            <td><?php echo $registro->observaciones ?></td>
                            <td>
                                <a name="editar" id="editar" class="btn btn-success btn-xs rounded-2" data-toggle="tooltip" title="Editar" href="recetas/editar?id=<?php echo $registro->id_receta; ?>" role="button"><i class="fas fa-edit fa-sm"></i></a>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="recetas/borrar?id=<?php echo $registro->id_receta; ?>" onclick="confirmarBorrado(event, <?php echo $registro->id_receta; ?>)"><i class="fas fa-trash fa-sm"></i></a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>
<?php
include("./templates/footer.php");
?>