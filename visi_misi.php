<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Landing Page SIPRAKA</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <link rel="icon" type="jpg" href="img/rakanya.jpg">


  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">

  <!-- =======================================================
  * Template Name: OnePage
  * Template URL: https://bootstrapmade.com/onepage-multipurpose-bootstrap-template/
  * Updated: Aug 07 2024 with Bootstrap v5.3.3
  * Author: BootstrapMade.com
  * License: https://bootstrapmade.com/license/
  ======================================================== -->
  <style>
  .mobile-nav-active .navbar-collapse {
    display: block !important;
  }

  .navbar-collapse {
    transition: all 0.3s ease-in-out;
  }

  /* Dropdown animasi */
  .dropdown-menu {
    display: none;
  }

  .dropdown-menu.show {
    display: block;
  }
</style>

</head>

<body class="index-page">

  <!-- Header -->
  <header id="header" class="sticky-top bg-light">
    <div class="container-fluid container-xl">
      <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm w-100">

        <!-- Logo -->
        <a class="navbar-brand" href="index.php">
          <img src="img/SMKN-2-BANGKALAN.png" alt="Logo" height="40">
        </a>

        <!-- Tombol Hamburger & SIPRAKA (Mobile) -->
        <div class="d-lg-none d-flex align-items-center ms-auto">
          <!-- Custom Hamburger Toggle -->
          <i class="mobile-nav-toggle bi bi-list d-lg-none fs-1 me-3" style="cursor: pointer;"></i>
          <!-- SIPRAKA (Mobile) -->
          <a class="btn btn-primary btn-sm text-white" href="login.php">SIPRAKA</a>
        </div>

        <!-- NAV MENU -->
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item">
              <a class="nav-link active" href="index.php">Home</a>
            </li>

            <!-- Dropdown Profil -->
            <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" role="button">Profil</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="visi_misi.php">Visi & Misi</a></li>
                <li><a class="dropdown-item" href="struktur.php">Struktur Organisasi</a></li>
              </ul>
            </li>

            <!-- Dropdown PKL -->
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">Kegiatan PKL</a>
              <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="alur.php">Alur Prakerin</a></li>
                <li><a class="dropdown-item" href="rekanan.php">Du/Di Rekanan</a></li>
              </ul>
            </li>

            <!-- SIPRAKA (Desktop) -->
            <li class="nav-item d-none d-lg-block">
              <a class="btn btn-primary text-white ms-lg-3" href="login.php">SIPRAKA</a>
            </li>
          </ul>
        </div>

      </nav>
    </div>
  </header>

<section id="visi_misi.php" class="py-5">
  <div class="container">
    <h2 class="fw-bold">Visi Misi Humas</h2>
    
    <h4 class="fw-bold mt-3">Visi</h4>
    <p>Membangun network dengan DU/DI dan Stakeholder secara sinergi, saling menguntungkan dan berkelanjutan.</p>

    <h4 class="fw-bold mt-3">Misi</h4>
    <ol>
      <li>Pelaksanaan Promosi sekolah ke DU/DI, SMP dan Lembaga lain melalui berbagai kegiatan (Kunjungan DU/DI, Website, PPDB, Prakerin, LKS, dan Tamu Alumni).</li>
      <li>Penelusuran Lulusan melalui SMS Center, surat, Jejaring social, website dan e-mail.</li>
      <li>Terjalin hubungan kerja/sosial yang harmonis antar warga sekolah maupun Komite Sekolah.</li>
      <li>Terjalin kerja sama dengan Lembaga/Instansi terkait.</li>
      <li>Pelaksanaan Prakerin pada DU/DI bertaraf nasional maupun Internasional.</li>
      <li>MoU dengan Dunia Usaha / Dunia Industri.</li>
      <li>Program Bursa Kerja Khusus (BKK) terlaksana.</li>
    </ol>
  </div>
</section>


<footer class="bg-light pt-4">
  <div class="container">
    <div class="row">
      <!-- Kolom Google Maps -->
      <div class="col-lg-4 col-md-6">
        <iframe
          src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3953.567961439648!2d112.746822!3d-7.048782!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd800ffb95aaf13%3A0x2c2633e22d23495b!2sJl.%20Halim%20Perdana%20Kusuma%2C%20Mlajah%2C%20Kec.%20Bangkalan%2C%20Kabupaten%20Bangkalan%2C%20Jawa%20Timur%2069115!5e0!3m2!1sid!2sid!4v1700000000000"
          width="100%" height="200" style="border:0;" allowfullscreen="" loading="lazy">
        </iframe>
      </div>

      <!-- Kolom Informasi Kontak -->
      <div class="col-lg-4 col-md-6">
        <h5 class="fw-bold">Informasi Kontak</h5>
        <p><i class="bi bi-geo-alt"></i> Jl. Halim Perdana Kusuma, Bangkalan - Jawa Timur</p>
        <p><i class="bi bi-envelope"></i> Email Address: <a href="mailto:smkn2_bkl@yahoo.com">smkn2_bkl@yahoo.com</a></p>
        <p><i class="bi bi-telephone"></i> 0313092223</p>
      </div>

      <!-- Kolom Layanan Kami -->
      <div class="col-lg-4 col-md-12">
        <h5 class="fw-bold">Layanan Kami</h5>
        <ul class="list-unstyled">
          <li><a href="#">Humas</a></li>
          <li><a href="#">Bursa Kerja Khusus</a></li>
          <li><a href="#">Lembaga Sertifikasi Profesi</a></li>
          <li><a href="#">Unit Produksi dan Jasa</a></li>
          <li><a href="#">Organisasi Siswa</a></li>
          <li><a href="#">Koperasi</a></li>
          <li><a href="#">Quiz Room</a></li>
        </ul>
      </div>
    </div>
  </div>
</footer>

    <hr>

    <!-- Bagian Bawah Footer -->
    <div class="text-center pb-3">
      <div class="mb-2">
        <a href="https://www.facebook.com/smkn2bkln/?_rdc=1&_rdr#" class="text-dark me-3"><i class="bi bi-facebook"></i></a>
        <a href="https://api.whatsapp.com/send/?phone=%2B6281234280648&text&type=phone_number&app_absent=0" class="text-dark me-3"><i class="bi bi-whatsapp"></i></a>
        <a href="https://www.instagram.com/smkn2_bangkalan?igsh=OTVpcDhkbDZtYzd2" class="text-dark me-3"><i class="bi bi-instagram"></i></a>
        <a href="https://www.youtube.com/channel/UCYpbJ6dTs7FDQRcQGyRxcgg" class="text-dark"><i class="bi bi-youtube"></i></a>
      </div>
      <p class="m-0">© Copyright 2022 | SMKN 2 Bangkalan All Rights Reserved.</p>
    </div>
  </div>
</footer>


  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>