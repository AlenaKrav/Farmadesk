<section id="services" class="services section">
  <div class="container section-title" data-aos="fade-up">
    <h2>Descubre nuestros servicios</h2>
    <p>Soluciones pensadas para tu bienestar, siempre con atención personalizada</p>
  </div>
  <div class="container">
    <div class="row g-5">
      <?php foreach ($serviciosActivos as $registro) { ?>
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
          <div class="service-item item-teal position-relative">
            <i class="<?php echo $registro->icono; ?>"></i>
            <h3><a href="" class="read-more stretched-link"><?php echo $registro->titulo; ?></a></h3>
            <p><?php echo $registro->descripcion; ?></p>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>