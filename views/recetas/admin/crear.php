<?php
$titulo = "Crear recetas";
$pagina_activa = "recetas";
include("./templates/header.php");
// print_r($_POST);
// print_r($_FILES);
?>
<div class="card">
    <div class="card-header">Dar de alta una receta</div>
    <div class="card-body">

        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="paciente_id" class="form-label">ID de Paciente:</label>
                <input type="text" class="form-control <?php echo isset($errores['paciente_id']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['paciente_id']) ? $_POST['paciente_id'] : ''; ?>" name="paciente_id" id="paciente_id" placeholder="Escribe el nombre del paciente">
                <?php if (isset($errores['paciente_id'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['paciente_id']; ?></div>
                <?php endif; ?>
                <div id="sugerencias"></div>
            </div>

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control <?php echo isset($errores['imagen']) ? 'is-invalid' : ''; ?>" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
                <?php if (isset($errores['imagen'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['imagen']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre fármaco:</label>
                <input type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
                <?php if (isset($errores['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control <?php echo isset($errores['fecha']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['fecha']) ? $_POST['fecha'] : ''; ?>" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
                <?php if (isset($errores['fecha'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['fecha']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="codigo_nacional" class="form-label">Codigo nacional:</label>
                <input type="text" class="form-control <?php echo isset($errores['codigo_nacional']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['codigo_nacional']) ? $_POST['codigo_nacional'] : ''; ?>" name="codigo_nacional" id="codigo_nacional" aria-describedby="helpId" placeholder="Codigo nacional" />
                <?php if (isset($errores['codigo_nacional'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['codigo_nacional']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <input type="text" class="form-control" value="<?php echo isset($_POST['observaciones']) ? $_POST['observaciones'] : ''; ?>" name="observaciones" id="observaciones" aria-describedby="helpId" placeholder="Observaciones" />
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/recetas" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<script>
    <?php
    include("./templates/footer.php");
    ?>