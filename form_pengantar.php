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
            <a href="index.html" class="navbar-brand mx-4 mb-3">
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
                <a href="tambahdata_admin.php" class="nav-item nav-link"><i class="fa-solid fa-calendar-plus me-2"></i>Tambah Data</a>
                <a href="form_permohonan.php" class="nav-item nav-link"><i class="fa-solid fa-th me-2"></i>Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="from_penarikan.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                <a href="form_surattugas.php" class="nav-item nav-link"><i class="fa-solid fa-envelope-open-text me-2"></i>Surat Tugas</a>
                <a href="form_pengantar.php" class="nav-item nav-link active"><i class="fa-solid fa-comment me-2"></i>Surat Pengantar</a>
                <a href="absensi_admin.php" class="nav-item nav-link"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Navbar Start -->
  <div class="content">
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-3 py-2 d-flex align-items-center" style="height: 56px;">
    <!-- Sidebar Toggler di Kiri -->
    <a href="#" class="sidebar-toggler me-auto">
        <i class="fa fa-bars"></i>
    </a>

    <!-- Tombol Lihat Data di Kanan -->
    <!-- <a href="surat_balasan.php" class="btn btn-primary btn-sm px-3">
        Lihat Data
    </a> -->
</nav>
<!-- Navbar End -->



        

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sipraka";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data Du/Di dari database
$sql = "SELECT id, nama_dudi, alamat FROM data_dudi";
$result = $conn->query($sql);
?>  

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="container mt-4">
                    <h2 class="text-center">Formulir Surat Pengantar</h2>

<form action="koneksi.php" method="POST">
    <div class="mb-3">
        <label class="form-label">Nomor Surat:</label>
        <input type="text" class="form-control" name="nomor_surat" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tempat PKL:</label>
        <select class="form-control" name="dudi_id" id="tempatPkl" required>
            <option value="">Pilih Du/Di</option>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <option value="<?= $row['id'] ?>" 
                        data-nama="<?= htmlspecialchars($row['nama_dudi']) ?>" 
                        data-alamat="<?= htmlspecialchars($row['alamat']) ?>">
                    <?= htmlspecialchars($row['nama_dudi']) ?>
                </option>
            <?php endwhile; ?>
        </select>
    </div>

    <!-- Input hidden untuk menyimpan nama Du/Di -->
    <input type="hidden" name="tempat_pkl" id="namaDudi">

    <div class="mb-3">
        <label class="form-label">Alamat PKL:</label>
        <textarea class="form-control" name="alamat_pkl" id="alamatPkl" required readonly></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Kota PKL:</label>
        <input type="text" class="form-control" name="kota_pkl" id="kotaPkl" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Konsentrasi Keahlian:</label>
        <input type="text" class="form-control" name="konsentrasi_keahlian" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Nama, NISN, dan Tingkat/Semester Siswa:</label>
        <textarea class="form-control" name="siswa" rows="4" required></textarea>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Mulai PKL:</label>
        <input type="date" class="form-control" name="tanggal_mulai" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Tanggal Berakhir PKL:</label>
        <input type="date" class="form-control" name="tanggal_berakhir" required>
    </div>

    <button type="submit" class="btn btn-primary">Buat Surat</button>
</form>
</div>
            </div>
        </div>
    </div>
</div>
<script>
document.getElementById("tempatPkl").addEventListener("change", function() {
    var selectedOption = this.options[this.selectedIndex];
    document.getElementById("namaDudi").value = selectedOption.getAttribute("data-nama");
    document.getElementById("alamatPkl").value = selectedOption.getAttribute("data-alamat");
});
</script>



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
