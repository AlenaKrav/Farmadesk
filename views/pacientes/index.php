<?php
$titulo = "Lista de pacientes";
$pagina_activa = "pacientes";
include("./templates/header.php");
// var_dump($pacientes);
?>
<div class="card">
    <div class="card-header">
        <a name="" id="" class="btn btn-success" href="<?php echo $url_base?>admin/pacientes/crear" role="button">Agregar registros</a>
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
                        <th scope="col">Direccion</th>
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
                                <a class="btn btn-info" href="pacientes/editar?id=<?php echo $registro->id_paciente; ?>">Editar</a>
                                <!-- <a class="btn btn-danger" href="pacientes/borrar?id=<?php echo $registro->id_paciente; ?>">Borrar</a> -->
                                <a href="pacientes/borrar?id=<?php echo $registro->id_paciente; ?>" class="btn btn-danger" onclick="confirmarBorrado(event, <?php echo $registro->id_paciente; ?>)">Borrar</a>
                                <!-- <a class="btn btn-danger" onclick="confirmarBorrado()">Borrar</a> -->
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

