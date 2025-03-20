<?php
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
                        <th scope="col">Telefono</th>
                        <th scope="col">Mensaje</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($consultas as $registro) { ?>
                    <tr class="">
                        <td><?php echo $registro->id ?></td>
                        <td><?php echo $registro->nombre ?></td>
                        <td><?php echo $registro->email ?></td>
                        <td><?php echo $registro->telefono ?></td>
                        <td><?php echo $registro->mensaje ?></td>
                        <td>
                         <a href="consultas-formulario/borrar?id=<?php echo $registro->id; ?>" onclick="confirmarBorrado(event, <?php echo $registro->id; ?>)" class="btn btn-danger">Borrar</a>
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