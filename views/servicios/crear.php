<?php
$titulo = "Añadir un nuevo servicio";
$pagina_activa = "servicios";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Añadir un nuevo servicio</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input type="text" class="form-control <?php echo isset($errores['icono']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['icono']) ? $_POST['icono'] : ''; ?>" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
                <?php if (isset($errores['icono'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['icono']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input type="text" class="form-control <?php echo isset($errores['titulo']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : ''; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
                <?php if (isset($errores['titulo'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['titulo']; ?></div>
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
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/servicios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>