<?php
$titulo = "Añadir una nueva receta";
$pagina_activa = "recetas";
include("./templates/paciente_header.php");
?>
<div class="card">
    <div class="card-header">Añadir una nueva receta</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">

            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <input type="file" class="form-control <?php echo isset($errores['imagen']) ? 'is-invalid' : ''; ?>" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
                <?php if (isset($errores['imagen'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['imagen']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre del fármaco:</label>
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
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base; ?>paciente/recetas" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/paciente_footer.php");
?>