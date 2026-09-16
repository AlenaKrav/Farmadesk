<?php
$titulo = "Añadir un nuevo usuario";
$pagina_activa = "usuarios";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Añadir un nuevo usuario</div>
    <div class="card-body">
        <form action="" method="post">
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
                <?php if (isset($errores['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control <?php echo isset($errores['apellidos']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['apellidos']) ? $_POST['apellidos'] : ''; ?>" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Apellidos" />
                <?php if (isset($errores['apellidos'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['apellidos']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control <?php echo isset($errores['usuario']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['usuario']) ? $_POST['usuario'] : ''; ?>" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
                <?php if (isset($errores['usuario'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['usuario']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control <?php echo isset($errores['password']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['password']) ? $_POST['password'] : ''; ?>" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña" />
                <?php if (isset($errores['password'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['password']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control <?php echo isset($errores['correo']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['correo']) ? $_POST['correo'] : ''; ?>" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
                <?php if (isset($errores['correo'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['correo']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="role_id" class="form-label">Tipo de usuario:</label>
                <select name="role_id" id="role_id" class="form-control" onchange="mostrarCampoPaciente()">
                    <option value="1" <?php echo (isset($_POST['role_id']) && $_POST['role_id'] == 1) ? 'selected="selected"' : ''; ?>>Admin</option>
                    <option value="3" <?php echo (isset($_POST['role_id']) && $_POST['role_id'] == 3) ? 'selected="selected"' : ''; ?>>Paciente</option>
                </select>
            </div>

            <div class="mb-3" id="campo_paciente" style="display: none;">
                <label for="id_paciente" class="form-label">ID Paciente:</label>
                <input type="text" value="<?php echo isset($_POST['id_paciente']) ? $_POST['id_paciente'] : ''; ?>" class="form-control <?php echo isset($errores['id_paciente']) ? 'is-invalid' : ''; ?>" id="paciente_id" name="id_paciente" aria-describedby="helpId" placeholder="Escribe el nombre del paciente" />
                <?php if (isset($errores['id_paciente'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['id_paciente']; ?></div>
                <?php endif; ?>
                <div id="sugerencias"></div>
            </div>

            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/usuarios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
    function mostrarCampoPaciente() {
        var rolSeleccionado = document.getElementById('role_id').value;
        var campoPaciente = document.getElementById('campo_paciente');
        if (rolSeleccionado === '3') {
            campoPaciente.style.display = 'block';
        } else {
            campoPaciente.style.display = 'none';
        }
    }
    window.onload = mostrarCampoPaciente;
</script>
<?php
include("./templates/footer.php");
?>