<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Mining MIS</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="{{ asset('front/assets/img/favicon.png') }}" rel="icon">
  <link href="{{ asset('front/assets/img/apple-touch-icon.png') }}" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="{{ asset('front/assets/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/aos/aos.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="{{ asset('front/assets/css/main.css') }}" rel="stylesheet">

</head>

<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container position-relative d-flex align-items-center justify-content-between">

      <a href="{{ url('/') }}" class="logo d-flex align-items-center me-auto me-xl-0">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <!-- <img src="assets/img/logo.webp" alt=""> -->
        <h1 class="sitename">Mining Management System</h1><span>.</span>
      </a>

      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="#hero" class="active">Home</a></li>
          <li><a href="#about">About</a></li>
          <li><a href="#features">Features</a></li>
          <li><a href="#contact">Contact</a></li>
        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

      <a class="btn-getstarted" href="{{ route('login') }}">Get Started</a>

    </div>
  </header>

  <main class="main">

    <!-- Hero Section -->
    <section id="hero" class="hero section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row align-items-center mb-5">
          <div class="col-lg-6 mb-4 mb-lg-0">
            <div class="badge-wrapper mb-3">
              <div class="d-inline-flex align-items-center rounded-pill border border-accent-light">
                <div class="icon-circle me-2">
                  <i class="bi bi-tools"></i>
                </div>
                <span class="badge-text me-3">Mining Site MIS</span>
              </div>
            </div>

            <h1 class="hero-title mb-4">Streamlining Mining Site Operations with Smart Management</h1>

            <p class="hero-description mb-4">
              Our Mining Site Management Information System (MIS) helps mining companies
              track staff, monitor safety incidents, manage equipment, and log attendance & shifts
              in one centralized platform. Enhance safety, improve efficiency, and make
              data-driven decisions to optimize site operations.
            </p>

            <div class="cta-wrapper">
              <a href="{{ url('/login') }}" class="btn btn-primary">Get Started</a>
              <a href="#features" class="btn btn-outline-secondary ms-2">Learn More</a>
            </div>
          </div>

          <div class="col-lg-6">
            <div class="hero-image">
              <img src="assets/img/illustration/mining-site.webp" alt="Mining Site Management" class="img-fluid" loading="lazy">
            </div>
          </div>
        </div>

        <div class="row feature-boxes" id="features">
          <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="200">
            <div class="feature-box">
              <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                <i class="bi bi-people"></i>
              </div>
              <div class="feature-content">
                <h3 class="feature-title">Staff & Attendance</h3>
                <p class="feature-text">Easily manage employee records, track attendance logs, and schedule shifts for seamless workforce management.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4 mb-4 mb-lg-0" data-aos="fade-up" data-aos-delay="300">
            <div class="feature-box">
              <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                <i class="bi bi-shield-exclamation"></i>
              </div>
              <div class="feature-content">
                <h3 class="feature-title">Safety Incident Tracking</h3>
                <p class="feature-text">Log, monitor, and resolve site safety incidents while ensuring compliance with safety regulations.</p>
              </div>
            </div>
          </div>

          <div class="col-lg-4" data-aos="fade-up" data-aos-delay="400">
            <div class="feature-box">
              <div class="feature-icon me-sm-4 mb-3 mb-sm-0">
                <i class="bi bi-bar-chart-line"></i>
              </div>
              <div class="feature-content">
                <h3 class="feature-title">Data & Insights</h3>
                <p class="feature-text">Access real-time dashboards and reports to monitor performance, resources, and make informed decisions.</p>
              </div>
            </div>
          </div>
        </div>

      </div>

    </section>
    <!-- /Hero Section -->



  </main>

  <footer id="footer" class="footer light-background">
    <div class="container">
      <div class="row gy-4">
        <div class="col-lg-5 col-md-12 footer-info">
          <a href="index.html" class="logo d-flex align-items-center">
            <!-- Uncomment the line below if you also wish to use an image logo -->
            <!-- <img src="assets/img/logo.webp" alt=""> -->
            <h1 class="sitename">Mining Management System</h1><span>.</span>
          </a>
          <p>Our Mining Site Management Information System (MIS) helps mining companies
              track staff, monitor safety incidents, manage equipment, and log attendance & shifts
              in one centralized platform. Enhance safety, improve efficiency, and make
              data-driven decisions to optimize site operations.</p>
          <div class="social-links d-flex mt-4">
            <a href="#" class="twitter"><i class="bi bi-twitter"></i></a>
            <a href="#" class="facebook"><i class="bi bi-facebook"></i></a>
            <a href="#" class="instagram"><i class="bi bi-instagram"></i></a>
            <a href="#" class="linkedin"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>
      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright</span> <strong class="px-1 sitename">{{ config('app.name') }}</strong> <span>All Rights Reserved</span></p>
      
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="{{ asset('front/assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/php-email-form/validate.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/aos/aos.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/glightbox/js/glightbox.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/imagesloaded/imagesloaded.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/isotope-layout/isotope.pkgd.min.js') }}"></script>
  <script src="{{ asset('front/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>

  <!-- Main JS File -->
  <script src="{{ asset('front/assets/js/main.js') }}"></script>

</body>

</html>