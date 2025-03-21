<?php
include("./templates/header.php");
print_r($_SESSION);
print_r($tarea->estado);
?>
<div class="card">
    <div class="card-header">Editar la información de los servicios</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="txtID" class="form-label">Id:</label>
                <input readonly value="<?php echo $tarea->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input value="<?php echo $tarea->nombre ?>" type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo $tarea->descripcion ?>" type="text" class="form-control" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
            </div>
            <div class="mb-3">
            <label for="estado" class="form-label">Estado:</label>
    <select name="estado" id="estado" class="form-control">
        <option value="Pendiente" <?php echo ($tarea->estado == "Pendiente" ? 'selected' : ''); ?>>Pendiente</option>
        <option value="En proceso" <?php echo ($tarea->estado == "En proceso" ? 'selected' : ''); ?>>En proceso</option>
        <option value="Terminada" <?php echo ($tarea->estado == "Terminada" ? 'selected' : ''); ?>>Terminada</option>
    </select>
            </div>
            <button type="submit" name="actualizar" class="btn btn-success">Actualizar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base ?>admin/tareas" role="button">Cancelar</a>
        </form>
    </div>
    <div class="card-footer text-muted"></div>
</div>

<?php
include("./templates/footer.php");
?>