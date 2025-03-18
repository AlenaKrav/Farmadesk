<?php
include("./templates/header.php");
// print_r($_POST);
?>
<div class="card">
    <div class="card-header">Crear un usuario</div>
    <div class="card-body">
        <form action="" method="post">
        <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
                    <div class="mb-3">
                <label for="apellidos" class="form-label">Apellidos:</label>
                <input type="text" class="form-control" name="apellidos" id="apellidos" aria-describedby="helpId" placeholder="Apellidos" />
            </div>
            <div class="mb-3">
                <label for="usuario" class="form-label">Usuario:</label>
                <input type="text" class="form-control" name="usuario" id="usuario" aria-describedby="helpId" placeholder="Usuario" />
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">Contraseña:</label>
                <input type="password" class="form-control" name="password" id="password" aria-describedby="helpId" placeholder="Contraseña" />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
            </div>
            <div class="mb-3">
            <label for="role_id" class="form-label">Tipo de usuario:</label>
    <select name="role_id" id="role_id" class="form-control" onchange="mostrarCampoPaciente()">
        <option value="1">Admin</option>
        <option value="2">Auxiliar</option>
        <option value="3">Paciente</option>
    </select>
            </div>

        <!-- Campo de paciente_id (oculto inicialmente) -->
        <div class="mb-3" id="campo_paciente" style="display: none;">
                <label for="id_paciente" class="form-label">ID Paciente:</label>
                <input type="text" class="form-control" id="paciente_id" name="id_paciente" aria-describedby="helpId" placeholder="Escribe el nombre del paciente" />
                <div id="sugerencias"></div>
            </div>
   
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/usuarios" role="button">Cancelar</a>
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
        campoPaciente.style.display = 'block';  // Mostrar campo
    } else {
        campoPaciente.style.display = 'none';   // Ocultar campo
    }
}
</script>
<?php
include("./templates/footer.php");
?>