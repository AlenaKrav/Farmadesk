<section id="team" class="team section light-background">
  <div class="container section-title" data-aos="fade-up">
    <h2>Conoce nuestro equipo</h2>
    <p>Profesionales cercanos y comprometido para ayudarte a mejorar tu salud</p>
  </div>
  <div class="container">
    <div class="row">
      <?php foreach ($miembrosEquipo as $miembro) { ?>
        <div class="col-lg-4 col-md-6 d-flex" data-aos="fade-up" data-aos-delay="100">
          <div class="member">
            <img src="assets/img/team/<?php echo $miembro->imagen ?>" class="img-fluid" alt="">
            <div class="member-content">
              <h4><?php echo $miembro->nombre ?></h4>
              <span><?php echo $miembro->puesto ?></span>
              <p><?php echo $miembro->descripcion ?></p>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div>
</section>