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
                <a href="index.html" class="navbar-brand mx-5 mb-4">
                    <h3 class="text-primary"> SIPRAKA</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/foto.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Siswa</h6>
                        <span>Online</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="dasboard_siswa.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Beranda</a>
                    <a href="absensi_siswa.php" class="nav-item nav-link"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
                    <a href="monitoring_siswa.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                    <a href="penarikan_siswa.php" class="nav-item nav-link active"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


        <div class="content">
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-3 py-2 d-flex align-items-center" style="height: 56px;">
    <!-- Sidebar Toggler di Kiri -->
    <a href="#" class="sidebar-toggler me-auto">
        <i class="fa fa-bars"></i>
    </a>

        </nav>
        <div class="container-fluid pt-4 px-4">
    <div class="row">
        <div class="col-12">
            <div class="bg-light rounded p-4 text-center mb-4 shadow-sm">
                <h3 class="text-primary fw-bold">JADWAL PENARIKAN</h3>
            </div>
        </div>
    </div>
</div>

<div class="container mt-4">
        <div class="row g-4"> <!-- Tambahkan gap antar card -->
            <?php
            include 'config.php';
            $query = "SELECT tempat_pkl, konsentrasi_keahlian, siswa_list, tanggal_surat FROM penarikan_pkl ORDER BY id DESC";
            $result = mysqli_query($conn, $query);
            
            if ($result->num_rows > 0):
                while ($row = mysqli_fetch_assoc($result)):
            ?>
                <div class="col-lg-4 col-md-6"> <!-- Agar responsif -->
                    <div class="card border-1 shadow-lg rounded-4 h-100 bg-white hover-effect">
                        <div class="card-body p-4">
                            <h5 class="card-title fw-bold text-dark">
                                <i class="bi bi-geo-alt"></i> <?= htmlspecialchars($row['tempat_pkl']); ?>
                            </h5>
                            <h6 class="card-subtitle mb-3 text-muted">
                                <i class="bi bi-book"></i> <?= htmlspecialchars($row['konsentrasi_keahlian']); ?>
                            </h6>
                            <p class="card-text">
                                <strong><i class="bi bi-people-fill"></i> Siswa:</strong><br>
                                <?php 
                                $siswa_list = explode("\n", $row['siswa_list']);
                                foreach ($siswa_list as $siswa) {
                                    echo "• " . htmlspecialchars($siswa) . "<br>";
                                }
                                ?>
                            </p>
                            <p class="text-muted">
                                <i class="bi bi-calendar-event"></i> Tanggal: <?= date("d F Y", strtotime($row['tanggal_surat'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
            <?php else: ?>
                <div class="col-12">
                    <div class="alert alert-warning text-center">
                        <i class="bi bi-exclamation-circle"></i> Belum ada data penarikan PKL.
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>

    <!-- Tambahkan CSS -->
    <style>
        .hover-effect {
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
        }
        .hover-effect:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
    </style>
    
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
