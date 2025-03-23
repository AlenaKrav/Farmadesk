<?php
$titulo = "Dar de alta un paciente";
$pagina_activa = "pacientes";
include("./templates/header.php");
// print_r($_POST);
?>

<div class="card">
    <div class="card-header">Dar de alta un paciente</div>
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
                <label for="dni" class="form-label">DNI:</label>
                <input type="text" class="form-control" name="dni" id="dni" aria-describedby="helpId" placeholder="DNI" />
            </div>
            <div class="mb-3">
                <label for="fecha_nacimiento" class="form-label">Fecha nacimiento:</label>
                <input type="date" class="form-control" name="fecha_nacimiento" id="fecha_nacimiento" aria-describedby="helpId" placeholder="Fecha nacimiento" />
            </div>
            <div class="mb-3">
                <label for="correo" class="form-label">Correo electrónico:</label>
                <input type="email" class="form-control" name="correo" id="correo" aria-describedby="helpId" placeholder="Correo" />
            </div>
            <div class="mb-3">
                <label for="telefono" class="form-label">Telefono:</label>
                <input type="tel" class="form-control" name="telefono" id="telefono" aria-describedby="helpId" placeholder="Telefono" />
            </div>
            <div class="mb-3">
                <label for="direccion" class="form-label">Direccion:</label>
                <input type="text" class="form-control" name="direccion" id="direccion" aria-describedby="helpId" placeholder="Direccion" />
            </div>
            <div class="mb-3">
                <label for="cip_aut" class="form-label">CIP-AUT:</label>
                <input type="text" class="form-control" name="cip_aut" id="cip_aut" aria-describedby="helpId" placeholder="CIP_AUT" />
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>admin/pacientes" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
                                var alertList = document.querySelectorAll(".alert");
                                alertList.forEach(function (alert) {
                                    new bootstrap.Alert(alert);
                                });
                            </script>
<?php
include("./templates/footer.php");
?>