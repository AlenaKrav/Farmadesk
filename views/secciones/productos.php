<?php
print_r($productosActivos);


?>
    <section id="portfolio" class="portfolio section">

      <!-- Section Title -->
      <div class="container section-title" data-aos="fade-up">
        <h2>Portfolio</h2>
        <p>Necessitatibus eius consequatur ex aliquid fuga eum quidem sint consectetur velit</p>
      </div>
      <!-- End Section Title -->

      <div class="container">

        <div class="isotope-layout" data-default-filter="*" data-layout="masonry" data-sort="original-order">


          <div class="row gy-4 isotope-container" data-aos="fade-up" data-aos-delay="200">
          <?php foreach($productosActivos as $producto) { ?>
            <div class="col-lg-4 col-md-6 portfolio-item isotope-item filter-product">
              <div class="portfolio-content h-100">
                <a href="assets/img/products/<?php echo $producto->imagen; ?>" data-gallery="portfolio-gallery-app" class="glightbox"><img src="assets/img/products/<?php echo $producto->imagen; ?>" class="img-fluid" alt=""></a>
                <div class="portfolio-info">
                  <h4><?php echo $producto->titulo?></h4>
                  <p><?php echo $producto->descripcion?></p>
                </div>
              </div>
            </div>
            <?php } ?><!-- End Portfolio Item -->
          </div><!-- End Portfolio Container -->
          
        </div>

      </div>

    </section>
    <!-- /Portfolio Section -->