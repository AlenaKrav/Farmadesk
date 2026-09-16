<?php
$url_base = "http://localhost/farma/";
?>
<link href="<?php echo $url_base; ?>assets/css/custom-styles.css" rel="stylesheet" />
<div class="col-lg-7">
  <form action="<?php echo $url_base ?>consulta/crear" method="post" id="contactForm" class="php-email-form" data-aos="fade-up" data-aos-delay="200">
    <div class="row gy-4">

      <div class="col-md-6">
        <label for="nombre" class="pb-2">Tu nombre</label>
        <input type="text" name="nombre" id="nombre" class="form-control <?php echo isset($errores['nombre']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['nombre']) ? $_POST['nombre'] : ''; ?>" required="">
        <div class="error text-danger"></div>
        <?php if (isset($errores['nombre'])): ?>
          <div class="invalid-feedback"><?php echo $errores['nombre']; ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-6">
        <label for="email" class="pb-2">Tu correo electrónico</label>
        <input type="email" class="form-control <?php echo isset($errores['email']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>" name="email" id="email" required="">
        <div class="error text-danger"></div>
        <?php if (isset($errores['email'])): ?>
          <div class="invalid-feedback"><?php echo $errores['email']; ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-12">
        <label for="telefono" class="pb-2">Tu teléfono de contacto</label>
        <input type="tel" class="form-control <?php echo isset($errores['telefono']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['telefono']) ? $_POST['telefono'] : ''; ?>" name="telefono" id="telefono" required="">
        <div class="error text-danger"></div>
        <?php if (isset($errores['telefono'])): ?>
          <div class="invalid-feedback"><?php echo $errores['telefono']; ?></div>
        <?php endif; ?>
      </div>

      <div class="col-md-12">
        <label for="mensaje" class="pb-2">Tu mensaje</label>
        <textarea class="form-control <?php echo isset($errores['mensaje']) ? 'is-invalid' : ''; ?>" value="<?php echo isset($_POST['mensaje']) ? $_POST['mensaje'] : ''; ?>" name="mensaje" rows="10" id="mensaje" required=""></textarea>
        <div class="error text-danger"></div>
        <?php if (isset($errores['mensaje'])): ?>
          <div class="invalid-feedback"><?php echo $errores['mensaje']; ?></div>
        <?php endif; ?>
      </div>
      <div class="col-md-12 text-center">
        <input id="BtnFormulario" type="submit" name="enviar" value="Enviar" />
      </div>

    </div>
  </form>
</div>