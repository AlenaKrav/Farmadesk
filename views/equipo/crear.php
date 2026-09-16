<?php
$titulo = "Añadir un nuevo miembro del equipo";
$pagina_activa = "equipo";
include("./templates/header.php");
?>

<div class="card">
    <div class="card-header">Añadir un nuevo miembro del equipo</div>
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
                <label for="nombre" class="form-label">Nombre:</label>
                <input type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
                <?php if (isset($errores['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto:</label>
                <input type="text" class="form-control <?php echo isset($errores['puesto']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['puesto']) ? $_POST['puesto'] : ''; ?>" name="puesto" id="puesto" aria-describedby="helpId" placeholder="Puesto" />
                <?php if (isset($errores['puesto'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['puesto']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input type="text" class="form-control <?php echo isset($errores['descripcion']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : ''; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/equipo" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>