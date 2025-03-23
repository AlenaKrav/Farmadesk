<?php
$url_base = "http://localhost/farma/";
// print_r($_POST);
?>
<div class="col-lg-7">
            <form action="<?php echo $url_base?>consulta/crear" method="post" id="contactForm" class="php-email-form" data-aos="fade-up" data-aos-delay="200">

            <!-- <form action="forms/contact.php" method="post" class="php-email-form" data-aos="fade-up" data-aos-delay="200"> -->
              <div class="row gy-4">

                <div class="col-md-6">
                  <label for="nombre" class="pb-2">Tu nombre</label>
                  <input type="text" name="nombre" id="nombre" class="form-control" required="">
                  <div class="error text-danger"></div>
                </div>

                <div class="col-md-6">
                  <label for="email" class="pb-2">Tu correo electrónico</label>
                  <input type="email" class="form-control" name="email" id="email" required="">
                  <div class="error text-danger"></div>
                </div>

                <div class="col-md-12">
                  <label for="telefono" class="pb-2">Tu teléfono de contacto</label>
                  <input type="tel" class="form-control" name="telefono" id="telefono" required="">
                  <div class="error text-danger"></div>
                </div>

                <div class="col-md-12">
                  <label for="mensaje" class="pb-2">Tu mensaje</label>
                  <textarea class="form-control" name="mensaje" rows="10" id="mensaje" required=""></textarea>
                  <div class="error text-danger"></div>
                </div>

                <div class="col-md-12 text-center">


                  <!-- <button name="enviar" type="submit">Enviar</button> -->
                  <input class="btn btn-primary btn-xl text-uppercase" id="submitButton" type="submit" name="enviar" value="Enviar" />
                  <!-- <input type="submit" name="enviar" value="Enviar" /> -->
                </div>

              </div>
            </form>
          </div>