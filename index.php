<?php
include_once("./app.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Farmadesk</title>
  <meta name="description" content="Farmadesk">
  <meta name="keywords" content="Farmadesk">

  <!-- Favicons -->
  <link href="/farma/assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: Green
  * Template URL: https://bootstrapmade.com/green-free-one-page-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
</head>

<body class="index-page">

  <header id="header" class="header sticky-top">

    <div class="topbar d-flex align-items-center accent-background">
      <div class="container d-flex justify-content-center justify-content-md-between">
        <div class="contact-info d-flex align-items-center">
          <i class="bi bi-envelope d-flex align-items-center"><a name="correo farmadesk" href="mailto:contact@example.com">info@farmadesk.com</a></i>
          <i class="bi bi-phone d-flex align-items-center ms-4"><span>+34 947 134 227</span></i>
        </div>
        <div class="social-links d-none d-md-flex align-items-center">
          <a href="https://x.com/farmadesk" name="twitter" class="twitter"><i class="bi bi-twitter-x"></i></a>
          <a href="https://www.facebook.com/farmadesk" name="facebook" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://www.instagram.com/farmadesk" name="instagram" class="instagram"><i class="bi bi-instagram"></i></a>
          <a href="https://www.linkedin.com/farmadesk" name="linkedin" class="linkedin"><i class="bi bi-linkedin"></i></a>
        </div>
      </div>
    </div>

    <div class="branding d-flex align-items-cente">

      <div class="container position-relative d-flex align-items-center justify-content-between">
        <a href="index.php" class="logo d-flex align-items-center">
          <img src="assets/img/logo.svg" alt="Logo Farmadesk">
          <h1 class="sitename">Farmadesk</h1>
        </a>

        <nav id="navmenu" class="navmenu">
          <ul>
            <li><a href="/farma/index.php" class="active">Inicio</a></li>
            <li><a href="#about">Sobre nosotros</a></li>
            <li><a href="#services">Servicios</a></li>
            <li><a href="#portfolio">Productos</a></li>
            <li><a href="#team">Equipo</a></li>
            <li><a href="#contact">Contacto</a></li>
            <li><a href="./login">Área Privada</a></li>
          </ul>
          <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
        </nav>

      </div>

    </div>

  </header>

  <main class="main">
    <section id="hero" class="hero section accent-background">

      <div id="hero-carousel" class="carousel slide carousel-fade" data-bs-ride="carousel" data-bs-interval="5000">

        <div class="carousel-item active">
          <img src="assets/img/hero-carousel/hero-carousel-1.jpg" alt="">
          <div class="carousel-container">
            <h2>Bienvenido a Farmadesk</h2>
            <p>Nos encargamos de simplificar todas tus gestiones de salud, todo en un solo lugar. Descubre un servicio rápido, eficiente y accesible desde cualquier dispositivo.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/hero-carousel-2.jpg" alt="">
          <div class="carousel-container">
            <h2>Atención personalizada</h2>
            <p>Nuestro equipo de profesionales está disponible para ofrecerte un servicio adaptado a tus necesidades. Estaremos encantados de resolver todas tus dudas y ayudarte a tomar la mejor decisión para tu salud.</p>
          </div>
        </div>

        <div class="carousel-item">
          <img src="assets/img/hero-carousel/hero-carousel-3.jpg" alt="">
          <div class="carousel-container">
            <h2>Soluciones eficaces para tu salud</h2>
            <p>¿No sabes por dónde a empezar a cuidarte? Te acompañamos en cada paso para que siempre tengas lo que necesitas, en el momento justo, con la calidad y atención que mereces</p>
          </div>
        </div>

        <a class="carousel-control-prev" href="#hero-carousel" role="button" data-bs-slide="prev">
          <span class="carousel-control-prev-icon bi bi-chevron-left" aria-hidden="true"></span>
        </a>

        <a class="carousel-control-next" href="#hero-carousel" role="button" data-bs-slide="next">
          <span class="carousel-control-next-icon bi bi-chevron-right" aria-hidden="true"></span>
        </a>

        <ol class="carousel-indicators"></ol>

      </div>

    </section>


    <section id="about" class="about section">


      <div class="container section-title" data-aos="fade-up">
        <h2>Sobre nosotros</h2>
        <p>Conoce nuestro valores, filosofia y trayectoria</p>
      </div>

      <div class="container">

        <div class="row gy-4">
          <div class="col-lg-6 position-relative align-self-start" data-aos="fade-up" data-aos-delay="100">
            <img src="assets/img/about.jpg" class="img-fluid" alt="">
          </div>
          <div class="col-lg-6 content" data-aos="fade-up" data-aos-delay="200">
            <h3>Farmadesk, un servicio de salud de calidad accesible y personalizado</h3>
            <p class="fst-italic">
              Queremos ofrecerte la mejor atención y servicios de salud con un enfoque integral.
              Nuestro objetivo es mejorar tu calidad de vida ofreciéndote el acceso rápido, eficiente y seguro a productos y servicios farmacéuticos.
            </p>
            <ul>
              <h4>Nuestros valores:</h4>
              <li><i class="bi bi-check2-all"></i> <span>Compromiso con la salud: Nos dedicamos a ofrecer atención personalizada para cada cliente.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Innovación y tecnología: Creemos en el uso de herramientas digitales para facilitar el acceso a productos y servicios farmacéuticos de forma rápida y segura.</span></li>
              <li><i class="bi bi-check2-all"></i> <span>Transparencia y confianza: Nos esforzamos por ofrecer siempre productos de calidad, con información clara y honesta sobre nuestros servicios.</span></li>
            </ul>
            <p>
              Con años de experiencia en el sector farmacéutico, Farmadesk ha evolucionado para ofrecer soluciones integrales a través de una plataforma web accesible desde cualquier lugar.
              Nuestra trayectoria está marcada por el constante crecimiento y la satisfacción de nuestros clientes, quienes son nuestra mayor inspiración.
            </p>
          </div>
        </div>

      </div>

    </section>
    <!-- Secciones con contenido dinami proveniente de las vistas -->
    <!-- Servicios -->
    <?php echo $serviciosActivos; ?>
    <!-- Porductos -->
    <?php echo $productosDisponibles; ?>
    <!-- Equipo -->
    <?php echo $miembrosEquipo; ?>

    <section id="contact" class="contact section">
      <div class="container section-title" data-aos="fade-up">
        <h2>Contacto</h2>
        <p>¿Tienes una duda? Ponte en contacto con nosotros de la manera más cómoda y facil para ti</p>
      </div>

      <div class="container" data-aos="fade-up" data-aos-delay="100">
        <div class="row gy-4">
          <div class="col-lg-5">
            <div class="info-wrap">
              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="200">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h3>Dirección</h3>
                  <p>Calle Historiador Domínguez Ortiz, 5 14002, Córdoba</p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-telephone flex-shrink-0"></i>
                <div>
                  <h3>Llámanos</h3>
                  <p>+34 947 134 227</p>
                </div>
              </div>

              <div class="info-item d-flex" data-aos="fade-up" data-aos-delay="400">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h3>Escríbenos un email</h3>
                  <p>info@farmadesk.com</p>
                </div>
              </div><!-- End Info Item -->
              <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3148.9071589345017!2d-4.772801517546336!3d37.88585383346527!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd6cdf81c0b90ca7%3A0x1ed09efb304ec0b5!2sC.%20Historiador%20Dom%C3%ADnguez%20Ortiz%2C%205%2C%20Centro%2C%2014002%20C%C3%B3rdoba!5e0!3m2!1sru!2ses!4v1744786567726!5m2!1sru!2ses" frameborder="0" style="border:0; width: 100%; height: 270px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Google Maps"></iframe>
            </div>
          </div>
          <!-- Inclusión de la vista con el fomrulario -->
          <?php include_once("../farma/views/secciones/formulario.php"); ?>
        </div>

      </div>

    </section>

  </main>

  <footer id="footer" class="footer dark-background">

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-about">
          <a href="index.php" class="logo d-flex align-items-center">
            <span class="sitename">Farmadesk</span>
          </a>
          <p>Cras fermentum odio eu feugiat lide par naso tierra. Justo eget nada terra videa magna derita valies darta donna mare fermentum iaculis eu non diam phasellus.</p>
          <div class="social-links d-flex mt-4">
            <a href="https://x.com/farmadesk"><i class="bi bi-twitter-x"></i></a>
            <a href="https://www.facebook.com/farmadesk"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/farmadesk"><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/farmadesk"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

        <div class="col-lg-2 col-6 footer-links">
          <h4>Enlaces de interés</h4>
          <ul>
            <li><a href="#about">Sobre nosotros</a></li>
            <li><a href="#services">Servicios</a></li>
            <li><a href="#portfolio">Productos</a></li>
            <li><a href="#team">Equipo</a></li>
            <li><a href="./login">Área privada</a></li>
            <li><a href="#">Política de Cookies</a></li>
            <li><a href="#">Política de Privacidad</a></li>
          </ul>
        </div>

        <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
          <h4>Contacto</h4>
          <p>Calle Historiador Domínguez Ortiz, 5 14002</p>
          <p>Córdoba, España</p>
          <p class="mt-4"><strong>Teléfono:</strong> <span>+34 947 134 227</span></p>
          <p><strong>Email:</strong> <span>info@farmadesk.com</span></p>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">Farmadesk</strong> <span>All Rights Reserved</span></p>
    </div>
  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>
  <script src="assets/js/validar.js"></script>

  <!-- Script para mostrar SweetAlert con la confirmación del envío del formulario -->
  <?php
  //recepcionamos el mensaje del controlador
  if (isset($_GET['mensaje'])) {
    $mensajeExito = $_GET['mensaje'];
  ?>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
      //mostramos el mensaje del éxito con SweetAlert
      Swal.fire({
        icon: 'success',
        title: '<?php echo $mensajeExito; ?>'
      });
    </script>
  <?php
  }
  ?>
</body>

</html>