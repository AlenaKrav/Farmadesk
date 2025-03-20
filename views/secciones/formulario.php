<?php
$url_base = "http://localhost/farma/";
// print_r($_POST);
?>
<div class="col-lg-7">
            <form action="<?php echo $url_base?>consulta/crear" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200">

            <!-- <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200"> -->
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="nombre" class="pb-2">Tu nombre</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" required="">
                </div>

                <div class="col-md-6">
                  <label for="email" class="pb-2">Tu correo electrónico</label>
                  <input type="email" class="form-control" name="email" id="email" required="">
                </div>

                <div class="col-md-12">
                  <label for="telefono" class="pb-2">Tu teléfono de contacto</label>
                  <input type="tel" class="form-control" name="telefono" id="telefono" required="">
                </div>

                <div class="col-md-12">
                  <label for="mensaje" class="pb-2">Tu mensaje</label>
                  <textarea class="form-control" name="mensaje" rows="10" id="mensaje" required=""></textarea>
                </div>

                <div class="col-md-12 text-center">
                  <!-- <div class="loading">Loading</div>
                  <div class="error-message"></div>
                  <div class="sent-message">Your message has been sent. Thank you!</div> -->

                  <button name="enviar" type="submit">Enviar</button>
                  <!-- <input type="submit" name="enviar" value="Enviar" /> -->
                </div>

              </div>
            </form>
          </div>