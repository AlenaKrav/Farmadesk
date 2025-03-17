<?php
include("./templates/header.php");
// print_r($usuarios);

?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="usuarios/crear" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Usuario</th>
                        <th scope="col">Correo</th>
                        <th scope="col">Tipo de usuario</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($usuarios as $registro) {?>
                    <tr class="">
                        <td><?php echo $registro->id;?></td>
                        <td><?php echo $registro->usuario;?></td>
                        <td><?php echo $registro->correo;?></td>
                        <td><?php echo $registro->role_nombre;?></td>
                        <td>
                            <a name="" id="" class="btn btn-info" href="usuarios/editar?id=<?php echo $registro->id?>" role="button">Editar</a>
                            <a name="" id="" class="btn btn-danger" href="usuarios/borrar?id=<?php echo $registro->id?>" role="button">Borrar</a>
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