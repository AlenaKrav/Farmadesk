<?php
$titulo = "Miembros del equipo";
$pagina_activa = "equipo";
include("./templates/header.php");
// var_dump($miembrosEquipo);
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base?>admin/equipo/crear" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Imagen</th>
                        <th scope="col">Nombre </th>
                        <th scope="col">Puesto</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($miembrosEquipo as $registro):?>
                    <tr class="">
                        <td><?php echo $registro->id?></td>                       
                        <td><img width="60px" src="<?php echo $url_base; ?>assets/img/team/<?php echo $registro->imagen; ?>"/></td>
                        <td><?php echo $registro->nombre?></td>
                        <td><?php echo $registro->puesto?></td>
                        <td><?php echo $registro->descripcion?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="equipo/editar?id=<?php echo $registro->id; ?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="equipo/borrar?id=<?php echo $registro->id; ?>" role="button">Borrar</a>
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