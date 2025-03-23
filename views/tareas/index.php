<?php
$titulo = "Lista de tareas";
$pagina_activa = "tareas";
include("./templates/header.php");
// print_r($tareas);
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/tareas/crear" role="button">Agregar registros</a>
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
                        <th scope="col">Descripcion</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Usuario actualizacion</th>
                        <th scope="col">Fecha actulizacion</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($tareas as $registro) {
                        $estado = $registro->estado;
                        if ($estado == "Pendiente") {
                            $estadoClase = "estado-pendiente"; // Rojo con texto blanco
                        } elseif ($estado == "En proceso") {
                            $estadoClase = "estado-proceso";
                        } elseif ($estado == "Terminada") {
                            $estadoClase = "estado-terminado"; // Verde con texto blanco
                        } else {
                            $estadoClase = ""; // Por defecto
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
                            <a name="" id="" class="btn btn-info" href="tareas/editar?id=<?php echo $registro->id; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="tareas/borrar?id=<?php echo $registro->id; ?>" role="button">Borrar</a>
                        </td>
                    </tr>
                    <?php }?>
                </tbody>
            </table>
        </div>

    </div>
</div>



<?php
include("./templates/footer.php");
?>