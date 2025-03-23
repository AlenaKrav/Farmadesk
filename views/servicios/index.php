<?php
$titulo = "Lista de servicios";
$pagina_activa = "servicios";
include("./templates/header.php");
// var_dump($servicio);
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="servicios/crear" role="button">Agregar registros</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Icono</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicio as $registro) { ?>
                        <tr class="">
                            <td><?php echo $registro->id; ?></td>
                            <td><i class="<?php echo $registro->icono; ?> fs-1"></i></td>
                            <td><?php echo $registro->titulo; ?></td>
                            <td><?php echo $registro->descripcion; ?></td>
                            <td>
                            <?php if ($registro->activo == 1): ?>
                                <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                <?php else: ?>
                                    <i class="bi bi-x-square-fill text-danger fs-5"></i>
                                <?php endif; ?>
                                </td>
                            <td>
                                <a name="" id="" class="btn btn-info" href="servicios/editar?id=<?php echo $registro->id ?>" role="button">Editar</a>
                                <a name="" id="" class="btn btn-danger" href="servicios/borrar?id=<?php echo $registro->id ?>" role="button">Borrar</a>
                                <?php if ($registro->activo == 1): ?>
                                    <a href="servicios/desactivar?id=<?php echo $registro->id; ?>" class="btn btn-warning">Desactivar</a>
                                <?php else: ?>
                                    <a href="servicios/activar?id=<?php echo $registro->id ?>" class="btn btn-success">Activar</a>
                                <?php endif; ?>
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