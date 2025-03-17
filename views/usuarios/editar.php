<?php
include("./templates/header.php");
var_dump($usuario);
// print_r($_POST);
?>
<div class="card">
    <div class="card-header">Editar la información de los usuarios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Id:</label>
                <input readonly value="<?php echo $usuario->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input value="<?php echo $usuario->usuario ?>" type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input value="<?php echo $usuario->password ?>" type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Password" />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo:</label>
                <input value="<?php echo $usuario->correo ?>" type="text" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
            </div>

            <div class="mb-3">
                <label for="role_id" class="form-label">Tipo de usuario:</label>
                <select name="role_id" id="role_id" class="form-control" onchange="mostrarCampoPaciente()">
                    <option value="1" <?php if ($usuario->role_id == 1) echo 'selected="selected"'; ?>>Admin</option>
                    <option value="2" <?php if ($usuario->role_id == 2) echo 'selected="selected"'; ?>>Auxiliar</option>
                    <option value="3" <?php if ($usuario->role_id == 3) echo 'selected="selected"'; ?>>Paciente</option>
                </select>
            </div>
                    <!-- Campo de paciente_id (oculto inicialmente) -->
        <div class="mb-3" id="campo_paciente" style="display: none;">
                <label for="id_paciente" class="form-label">ID Paciente:</label>
                <input type="text" class="form-control" id="id_paciente" name="id_paciente" aria-describedby="helpId" placeholder="Id de Paciente" />
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>usuarios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
    // Función para mostrar/ocultar el campo de paciente_id
    function mostrarCampoPaciente() {
        var rolSeleccionado = document.getElementById('role_id').value;
        console.log(rolSeleccionado);
        var campoPaciente = document.getElementById('campo_paciente');

        if (rolSeleccionado === '3') {
            campoPaciente.style.display = 'block'; // Mostrar campo
        } else {
            campoPaciente.style.display = 'none'; // Ocultar campo
        }
    }
</script>
<?php
include("./templates/footer.php");
?>