<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>SIPRAKA</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <link rel="icon" type="jpg" href="img/rakanya.jpg">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
</head>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <!-- Sidebar Start -->
        <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="tambahdata_admin.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">SIPRAKA</h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="img/foto.jpg" alt="" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">Admin</h6>
                    <span>Online</span>
                </div>
            </div>
        <div class="navbar-nav w-100">
            <a href="dasboard_admin.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
            <a href="tambahdata_admin.php" class="nav-item nav-link active"><i class="fa fa-calendar-plus me-2"></i>Tambah Data</a>
            <a href="permohonan_admin.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Permohonan</a>
            <a href="form.html" class="nav-item nav-link"><i class="fa fa-eye me-2"></i>Monitoring</a>
            <a href="table.html" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
            <a href="chart.html" class="nav-item nav-link"><i class="fa fa-pen me-2"></i>Absensi</a>
        </div>
    </nav>
</div>
 <!-- Content Start -->
 <div class="content">
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0">
            <a href="index.html" class="navbar-brand d-flex d-lg-none me-4">
                <h2 class="text-primary mb-0"><i class="fa fa-hashtag"></i></h2>
            </a>
            <a href="#" class="sidebar-toggler flex-shrink-0">
                <i class="fa fa-bars"></i>
            </a>
            <div class="nav-item dropdown ms-auto">
                <a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown">
                    <img class="rounded-circle me-lg-2" src="img/foto.jpg" alt="" style="width: 40px; height: 40px;">
                    <span class="d-none d-lg-inline-flex">Admin</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="login.php" class="dropdown-item">Keluar</a>
                </div>
            </div>
        </nav>
        <!-- Navbar End -->


            <!-- Other Elements Start -->
            <div class="container-fluid pt-4 px-4">
    <div class="row">
        <!-- Card Tambah Data -->
        <div class="col-12">
            <div class="bg-light rounded p-4 text-center">
                <h3 class="text-primary">TAMBAH DATA</h3>
                <p>Lengkapi informasi di bawah ini untuk menambahkan data yang diperlukan dalam sistem.</p>
            </div>
        </div>
    </div>

  <!-- Row untuk 4 Card -->
<div class="row mt-4">
    <!-- Card Data Du/Di -->
    <div class="col-md-3">
        <div class="card bg-light text-center p-3 h-100 d-flex flex-column justify-content-between">
            <i class="fa fa-building text-warning fs-1"></i>
            <h5 class="mt-3">Data Du/Di</h5>
            <p class="flex-grow-1">Kelola data Dunia Usaha/Dunia Industri secara efisien.</p>
            <a href="data_dudi.php" class="btn btn-warning mt-auto">Tambah Data</a>
        </div>
    </div>

    <!-- Card Data Siswa -->
    <div class="col-md-3">
        <div class="card bg-light text-center p-3 h-100 d-flex flex-column justify-content-between">
            <i class="fa fa-user-graduate text-primary fs-1"></i>
            <h5 class="mt-3">Data Siswa</h5>
            <p class="flex-grow-1">Kelola data siswa yang terdaftar dalam sistem.</p>
            <a href="data_siswa.php" class="btn btn-primary mt-auto">Tambah Data</a>
        </div>
    </div>

    <!-- Card Data Pembimbing -->
    <div class="col-md-3">
        <div class="card bg-light text-center p-3 h-100 d-flex flex-column justify-content-between">
            <i class="fa fa-user-tie text-success fs-1"></i>
            <h5 class="mt-3">Data Pembimbing</h5>
            <p class="flex-grow-1">Kelola data pembimbing yang mendampingi siswa.</p>
            <a href="data_pembimbing.php" class="btn btn-success mt-auto">Tambah Data</a>
        </div>
    </div>

    <!-- Card Semua Data -->
    <div class="col-md-3">
        <div class="card bg-light text-center p-3 h-100 d-flex flex-column justify-content-between">
            <i class="fa fa-database text-secondary fs-1"></i>
            <h5 class="mt-3">Semua Data</h5>
            <p class="flex-grow-1">Lihat dan kelola semua data yang telah diinputkan.</p>
            <a href="data_semua.php" class="btn btn-secondary mt-auto">Lihat Data</a>
        </div>
    </div>
</div>

                    
            <!-- Other Elements End -->


          <!-- Footer Start -->
          <div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4">
                <div class="row">
                    <div class="col-12 col-sm-6 text-center text-sm-start">
                        &copy; <a href="#">2025 SIPRAKA</a>, All Right Reserved.
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Content End -->
</div>
<!-- Footer End -->



        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>

    <!-- JavaScript Libraries -->
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/chart/chart.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="lib/tempusdominus/js/moment.min.js"></script>
    <script src="lib/tempusdominus/js/moment-timezone.min.js"></script>
    <script src="lib/tempusdominus/js/tempusdominus-bootstrap-4.min.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
</body>

</html>