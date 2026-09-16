<?php
$titulo = "Editar un servicio";
$pagina_activa = "servicios";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Editar un servicio</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">Id:</label>
                <input readonly value="<?php echo $servicio->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="icono" class="form-label">Icono:</label>
                <input value="<?php echo isset($_POST['icono']) ? $_POST['icono'] : $servicio->icono; ?>" type="text" class="form-control <?php echo isset($errores['icono']) ? 'is-invalid' : ''; ?>" name="icono" id="icono" aria-describedby="helpId" placeholder="Icono" />
                <?php if (isset($errores['icono'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['icono']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : $servicio->titulo; ?>" type="text" class="form-control <?php echo isset($errores['titulo']) ? 'is-invalid' : ''; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
                <?php if (isset($errores['titulo'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['titulo']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : $servicio->descripcion; ?>" type="text" class="form-control <?php echo isset($errores['descripcion']) ? 'is-invalid' : ''; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/servicios" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>