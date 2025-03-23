<?php
$titulo = "Edición de pacientes";
$pagina_activa = "pacientes";
include("./templates/header.php");
// print_r($_POST);
?>

<div class="card">
    <div class="card-header">Editar la ficha del paciente</div>
    <div class="card-body">
        <form action="" method="post">
        <div class="mb-3">
                <label for="id_paciente" class="form-label">Id:</label>
                <input readonly value="<?php echo $paciente->id_paciente ?>" type="text" class="form-control" name="id_paciente" id="id_paciente" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo $paciente->nombre ?>" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" value="<?php echo $paciente->apellidos ?>"class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Apellidos" />
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" value="<?php echo $paciente->dni ?>"class="form-control" name="dni" id="dni" aria-describedby="helpId" placeholder="DNI" />
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" value="<?php echo $paciente->fecha_nacimiento ?>" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId" placeholder="Fecha nacimiento" />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" value="<?php echo $paciente->correo ?>"class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" value="<?php echo $paciente->telefono ?>" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono" />
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" value="<?php echo $paciente->direccion ?>" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion" />
            </div>
            <div class="mb-3">
                <label for="cip_aut" class="form-label">CIP-AUT:</label>
                <input type="text" value="<?php echo $paciente->cip_aut ?>" class="form-control" name="cip_aut" id="cip_aut" aria-describedby="helpId" placeholder="CIP_AUT" />
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/pacientes" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>