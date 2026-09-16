<?php
$titulo = "Listado de servicios";
$pagina_activa = "servicios";
include("./templates/header.php");
?>

<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="servicios/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir un nuevo servicio</a>
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
                        <th scope="col">Título</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Activo</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($servicios as $registro) { ?>
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
                            <a name="editar" id="editar" class="btn btn-success btn-xs rounded-2" data-toggle="tooltip" title="Editar" href="servicios/editar?id=<?php echo $registro->id ?>" role="button"><i class="fas fa-edit fa-sm"></i></a>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="servicios/borrar?id=<?php echo $registro->id ?>" onclick="confirmarBorrado(event, <?php echo $registro->id; ?>)"><i class="fas fa-trash fa-sm"></i></a>
                                <?php if ($registro->activo == 1): ?>
                                    <a name="desactivar" id="desactivar" href="servicios/desactivar?id=<?php echo $registro->id; ?>" class="btn btn-secondary btn-xs rounded-2" data-toggle="tooltip" title="Desactivar"><i class="fas fa-eye-slash fa-sm"></i></a>
                                <?php else: ?>
                                    <a name="activar" id="activar" href="servicios/activar?id=<?php echo $registro->id ?>" class="btn btn-info btn-xs rounded-2" data-toggle="tooltip" title="Activar"><i class="fas fa-eye fa-sm"></i></a>
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