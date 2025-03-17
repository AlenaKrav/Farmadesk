<?php
include("./templates/header.php");
print_r($_POST);
print_r($_FILES);
?>
<div class="card">
    <div class="card-header">Dar de alta una receta</div>
    <div class="card-body">
        <form action="" enctype="multipart/form-data" method="post">
        <div class="mb-3">
                <label for="paciente_id" class="form-label">ID de Paciente:</label>
                <input type="text" class="form-control" name="paciente_id" id="paciente_id" aria-describedby="helpId" placeholder="Escribe el nombre del paciente" />
                <div id="sugerencias"></div>
            </div>

            <div class="mb-3">
    <label for="imagen" class="form-label">Imagen:</label>
    <input type="file" class="form-control" name="imagen" id="imagen" aria-describedby="helpId" placeholder="Imagen"/>
</div>
<div class="mb-3">
                <label for="nombre" class="form-label">Nombre fármaco:</label>
                <input type="text" class="form-control" name="nombre" id="nombre" aria-describedby="helpId" placeholder="Nombre" />
            </div>
            <div class="mb-3">
                <label for="fecha" class="form-label">Fecha:</label>
                <input type="date" class="form-control" name="fecha" id="fecha" aria-describedby="helpId" placeholder="Fecha" />
            </div>
            <div class="mb-3">
                <label for="codigo_nacional" class="form-label">Codigo nacional:</label>
                <input type="text" class="form-control" name="codigo_nacional" id="codigo_nacional" aria-describedby="helpId" placeholder="Codigo nacional" />
            </div>
            <div class="mb-3">
                <label for="observaciones" class="form-label">Observaciones:</label>
                <input type="text" class="form-control" name="observaciones" id="observaciones" aria-describedby="helpId" placeholder="Observaciones" />
            </div>
            <button type="submit" name="agregar" class="btn btn-success">Agregar</button>
            <a name="" id="" class="btn btn-primary" href="<?php echo $url_base?>recetas" role="button">Cancelar</a>
        </form>

    </div>
    <div class="card-footer text-muted"></div>
</div>
<?php
include("./templates/footer.php");
?>