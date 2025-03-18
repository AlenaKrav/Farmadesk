<?php
include("./templates/paciente_header.php");
// print_r($_POST);
// print_r($_FILES);
// print_r($_SESSION);
// print_r($recetasPaciente);
// echo "Inicio recetas paciente"
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>paciente/recetas/crear" role="button">Agregar una nueva receta</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre fármaco</th>
                        <th scope="col">Fecha</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($recetasPaciente as $registro):?>
                        <?php
                        $estado = $registro->estado;
                        if ($estado == "Enviada") {
                            $estadoClase = "estado-enviada";
                        } elseif ($estado == "En proceso") {
                            $estadoClase = "estado-proceso";
                        } elseif ($estado == "Completada") {
                            $estadoClase = "estado-terminado"; 
                        }elseif ($estado == "Rechazada") {
                            $estadoClase = "estado-rechazado"; 
                        } 
                        else {
                            $estadoClase = ""; // Por defecto
                        }                     
                        ?>
                    <tr class="">                     
                        <td><img width="60px" src="<?php echo $url_base; ?>assets/img/recetas/<?php echo $registro->imagen_receta; ?>"/></td>
                        <td><?php echo $registro->nombre?></td>
                        <td><?php echo $registro->fecha?></td>
                        <td><span class="<?php echo $estadoClase; ?>"><?php echo $estado; ?></span></td>
                        <td>
                            <!-- <a name="" id="" class="btn btn-info" href="recetas/editar?id=<?php echo $registro->id_receta; ?>" role="button">Editar</a> -->
                            <a name="" id="" class="btn btn-danger" href="recetas/borrar?id=<?php echo $registro->id_receta; ?>" role="button">Borrar</a>
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
