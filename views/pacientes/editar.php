<?php
$titulo = "Editar un paciente";
$pagina_activa = "pacientes";
include("./templates/header.php");
?>

<div class="card">
    <div class="card-header">Editar un paciente</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="id_paciente" class="form-label">Id:</label>
                <input readonly value="<?php echo $paciente->id_paciente ?>" type="text" class="form-control" name="id_paciente" id="id_paciente" aria-describedby="helpId" placeholder="Id">
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $paciente->nombre; ?>" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre">
                <?php if (isset($errores['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : $paciente->apellidos; ?>" class="form-control <?php echo isset($errores['apellidos']) ? 'is-invalid' : ''; ?>" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Apellidos">
                <?php if (isset($errores['apellidos'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['apellidos']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" value="<?php echo isset($_POST['dni']) ? $_POST['dni'] : $paciente->dni; ?>" class="form-control <?php echo isset($errores['dni']) ? 'is-invalid' : ''; ?>" name="dni" id="dni" aria-describedby="helpId" placeholder="DNI">
                <?php if (isset($errores['dni'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['dni']; ?></div>
                <?php endif; ?>

            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" value="<?php echo isset($_POST['fecha_nacimiento']) ? $_POST['fecha_nacimiento'] : $paciente->fecha_nacimiento; ?>" class="form-control <?php echo isset($errores['fecha_nacimiento']) ? 'is-invalid' : ''; ?>" name="fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId" placeholder="Fecha nacimiento">
                <?php if (isset($errores['fecha_nacimiento'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['fecha_nacimiento']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : $paciente->correo; ?>" class="form-control <?php echo isset($errores['correo']) ? 'is-invalid' : ''; ?>" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo">
                <?php if (isset($errores['correo'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['correo']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : $paciente->telefono; ?>" class="form-control <?php echo isset($errores['telefono']) ? 'is-invalid' : ''; ?>" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono">
                <?php if (isset($errores['telefono'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['telefono']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" value="<?php echo isset($_POST['direccion']) ? $_POST['direccion'] : $paciente->direccion; ?>" class="form-control <?php echo isset($errores['direccion']) ? 'is-invalid' : ''; ?>" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion">
                <?php if (isset($errores['direccion'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['direccion']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="cip_aut" class="form-label">CIP-AUT:</label>
                <input type="text" value="<?php echo isset($_POST['cip_aut']) ? $_POST['cip_aut'] : $paciente->cip_aut; ?>" class="form-control <?php echo isset($errores['cip_aut']) ? 'is-invalid' : ''; ?>" name="cip_aut" id="cip_aut" aria-describedby="helpId" placeholder="CIP_AUT">
                <?php if (isset($errores['cip_aut'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['cip_aut']; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/pacientes" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>