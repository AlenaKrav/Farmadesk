<?php
$titulo = "Editar productos";
$pagina_activa = "productos";
include("./templates/header.php");
print_r($producto);
?>
<div class="card">
    <div class="card-header">Editar la información del producto</div>
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
                <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen" />
            </div>
            <div class="mb-3">
                <label for="titulo" class="form-label">Titulo:</label>
                <input value="<?php echo $producto->titulo ?>" type="text" class="form-control" name="titulo" id="titulo" aria-describedby="helpId" placeholder="Titulo" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo $producto->descripcion ?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
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