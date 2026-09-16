<?php
$titulo = "Editar una tarea";
$pagina_activa = "tareas";
include("./templates/header.php");
?>
<div class="card">
    <div class="card-header">Editar una tarea</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
            <div class="mb-3">
                <label for="txtID" class="form-label">Id:</label>
                <input readonly value="<?php echo $tarea->id ?>" type="text" class="form-control" name="id" id="id" aria-describedby="helpId" placeholder="Id" />
            </div>
            <div class="mb-3">
                <label for="nombre" class="form-label">Nombre:</label>
                <input value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : $tarea->nombre; ?>" type="text" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
                <?php if (isset($errores['nombre'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripcion:</label>
                <input value="<?php echo isset($_POST['descripcion']) ? $_POST['descripcion'] : $tarea->descripcion; ?>" type="text" class="form-control <?php echo isset($errores['descripcion']) ? 'is-invalid' : ''; ?>" name="descripcion" id="descripcion" aria-describedby="helpId" placeholder="Descripcion" />
                <?php if (isset($errores['descripcion'])): ?>
                    <div class="invalid-feedback"><?php echo $errores['descripcion']; ?></div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label for="estado" class="form-label">Estado:</label>
                <select name="estado" id="estado" class="form-control">
                    <option value="Pendiente" <?php echo (isset($_POST['estado']) ? ($_POST['estado'] == "Pendiente" ? 'selected' : '') : ($tarea->estado == "Pendiente" ? 'selected' : '')); ?>>Pendiente</option>
                    <option value="En proceso" <?php echo (isset($_POST['estado']) ? ($_POST['estado'] == "En proceso" ? 'selected' : '') : ($tarea->estado == "En proceso" ? 'selected' : '')); ?>>En proceso</option>
                    <option value="Terminada" <?php echo (isset($_POST['estado']) ? ($_POST['estado'] == "Terminada" ? 'selected' : '') : ($tarea->estado == "Terminada" ? 'selected' : '')); ?>>Terminada</option>
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