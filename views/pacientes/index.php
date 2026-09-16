<?php
$titulo = "Listado de pacientes";
$pagina_activa = "pacientes";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base ?>admin/pacientes/crear" role="button"><i class="bi bi-plus-lg"></i>Añadir un nuevo paciente</a>
    </div>
    <div class="card-body">
        <div
            class="table-responsive">
            <table
                class="table">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Nombre completo</th>
                        <th scope="col">Información personal</th>
                        <th scope="col">Fecha de nacimiento</th>
                        <th scope="col">Información adicional</th>
                        <th scope="col">Dirección</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pacientes as $registro): ?>
                        <tr class="">
                            <td><?php echo $registro->id_paciente; ?></td>
                            <td><?php echo $registro->nombre . " " . $registro->apellidos; ?></td>
                            <td><?php echo $registro->dni . "<br>" . $registro->cip_aut; ?></td>
                            <td><?php echo $registro->fecha_nacimiento; ?></td>
                            <td><?php echo $registro->correo . "<br>" . $registro->telefono; ?></td>
                            <td><?php echo $registro->direccion; ?></td>
                            <td>
                                <a name="editar" id="editar" class="btn btn-success btn-xs rounded-2" data-toggle="tooltip" title="Editar" href="pacientes/editar?id=<?php echo $registro->id_paciente; ?>" role="button"><i class="fas fa-edit fa-sm"></i></a>
                                <a name="borrar" id="borrar" class="btn btn-danger btn-xs rounded-2" data-toggle="tooltip" title="Borrar" href="pacientes/borrar?id=<?php echo $registro->id_paciente; ?>" onclick="confirmarBorrado(event, <?php echo $registro->id_paciente; ?>)"><i class="fas fa-trash fa-sm"></i></a>
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