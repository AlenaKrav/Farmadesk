<?php
$titulo = "Listado de recetas";
$pagina_activa = "recetas";
include("./templates/paciente_header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base ?>paciente/recetas/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir una nueva receta</a>
    </div>
    <div class="card-body">
        <div
            class="table table-striped table-bordered align-middle text-center">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre del fármaco</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($recetasPaciente as $registro): ?>
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
                            <td>
                                <a href="<?php echo $url_base; ?>assets/img/recetas/<?php echo $registro->imagen_receta; ?>" target="_blank" title="Ver imagen en tamaño completo">
                                    <img class="clickable" src="<?php echo $url_base; ?>assets/img/recetas/<?php echo $registro->imagen_receta; ?>" />
                            </td>
                            <td><?php echo $registro->nombre ?></td>
                            <td><?php echo $registro->fecha ?></td>
                            <td><span class="paciente-<?php echo $estadoClase; ?>"><?php echo $estado; ?></span></td>
                            <td>
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
include("./templates/paciente_footer.php");
?>