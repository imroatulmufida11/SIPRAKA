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
                <a href="dasboard_siswa.php" class="navbar-brand mx-5 mb-4">
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
                    <a href="absensi_siswa.php" class="nav-item nav-link active"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
                    <a href="monitoring_siswa.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                    <a href="penarikan_siswa.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                </div>
            </nav>
        </div>
        <!-- Sidebar End -->


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
            <?php
// Konfigurasi koneksi ke database
$host = "localhost";
$user = "root";
$password = "";
$database = "db_sipraka";

$conn = new mysqli($host, $user, $password, $database);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil daftar jurusan unik dari database
$sql_jurusan = "SELECT DISTINCT jurusan FROM absensi";
$result_jurusan = $conn->query($sql_jurusan);
?>

<div class="container mt-4">
    <h2 class="text-center mb-4">Data Absensi</h2>

    <div class="row">
        <?php while ($row_jurusan = $result_jurusan->fetch_assoc()) { 
            $jurusan = $row_jurusan['jurusan'];

            // Ambil 2 data absensi terbaru berdasarkan jurusan
            $sql_absensi = "SELECT nama, tanggal, keterangan FROM absensi WHERE jurusan = ? AND tanggal != '0000-00-00' ORDER BY tanggal DESC LIMIT 2";
            $stmt = $conn->prepare($sql_absensi);
            $stmt->bind_param("s", $jurusan);
            $stmt->execute();
            $result_absensi = $stmt->get_result();

            // Cek apakah ada data valid
            if ($result_absensi->num_rows == 0) {
                continue; // Lewati jurusan jika tidak ada data absensi yang valid
            }
        ?>
            <div class="col-md-4">
                <div class="card mb-3">
                    <div class="card-header bg-primary text-white text-center">
                        <h5><?php echo htmlspecialchars($jurusan); ?></h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-group">
                            <?php while ($absensi = $result_absensi->fetch_assoc()) { ?>
                                <li class="list-group-item">
                                    <strong><?php echo htmlspecialchars($absensi['nama']); ?></strong> <br>
                                    <small class="text-muted"><?php echo htmlspecialchars($absensi['tanggal']); ?></small> <br>
                                    <span class="badge bg-info text-wrap d-block"><?php echo htmlspecialchars($absensi['keterangan']); ?></span>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-footer text-center">
                        <a href="detail_absensi.php?jurusan=<?php echo urlencode($jurusan); ?>" class="btn btn-sm btn-primary">Lihat Semua</a>
                    </div>
                </div>
            </div>
        <?php 
            $stmt->close();
        } ?>
    </div>

    <div class="text-center mt-3">
        <a href="absensi_siswa.php" class="btn btn-secondary">Kembali</a>
    </div>
</div>

<style>
    .list-group-item {
        word-wrap: break-word; /* Memastikan teks tidak keluar */
        overflow-wrap: break-word;
        white-space: normal;
    }

    .badge {
        word-break: break-word; /* Mencegah teks panjang keluar */
        max-width: 100%; /* Batasi agar tetap di dalam card */
        display: inline-block;
    }
</style>

<?php
$conn->close();
?>

             <!-- Footer Start -->
             <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">2025 SIPRAKA</a>, SMK Negeri 2 Bangkalan 
                        </div>
                    </div>
                </div>
            </div>
            <!-- Footer End -->
        </div>
        <!-- Content End -->


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