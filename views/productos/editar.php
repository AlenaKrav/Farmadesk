<?php
$titulo = "Editar un producto";
$pagina_activa = "productos";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Editar un producto</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="id" class="form-label">Id:</label>
                <input readonly value="<?php echo $producto->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="imagen" class="form-label">Imagen:</label>
                <a href="<?php echo $url_base; ?>assets/img/products/<?php echo $producto->imagen; ?>" target="_blank" title="Ver imagen en tamaño completo">
                    <img class="clickable" src="<?php echo $url_base; ?>assets/img/products/<?php echo $producto->imagen; ?>" />
                </a>
                <input type="file" class="form-control <?php echo isset($errores['imagen']) ? 'is-invalid' : ''; ?>" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
                <?php if (isset($errores['imagen'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['imagen']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input value="<?php echo isset($_POST['titulo']) ? $_POST['titulo'] : $producto->titulo; ?>" type="text" class="form-control <?php echo isset($errores['titulo']) ? 'is-invalid' : ''; ?>" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
                <?php if (isset($errores['titulo'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['titulo']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : $producto->descripcion; ?>" type="text" class="form-control <?php echo isset($errores['descripcion']) ? 'is-invalid' : ''; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/productos" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>