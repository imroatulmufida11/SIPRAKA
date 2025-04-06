<?php
session_start();
require_once __DIR__ . '/config.php';

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data Guru Pembimbing
$pembimbing_result = $conn->query("SELECT id, nama_pembimbing FROM data_pembimbing");

// Ambil data Tempat DUDI
$dudi_result = $conn->query("SELECT id, nama_dudi FROM data_dudi");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $guru_pembimbing = $_POST["guru_pembimbing"];
    
    // Ambil siswa dari textarea, pecah per baris, hapus spasi kosong, lalu gabungkan dengan koma
    $siswaArray = array_map('trim', explode("\n", $_POST["siswaList"]));
    $siswa_pkl = implode(", ", $siswaArray); 

    $tempat_dudi = $_POST["tempat_dudi"];
    $tanggal_pelaksanaan = $_POST["tanggal_pelaksanaan"];
    $catatan_monitoring = $_POST["catatan_monitoring"];

    $dokumentasi = "";

    // Proses unggah gambar
    if (!empty($_FILES["dokumentasi"]["name"])) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }
        $dokumentasi = $target_dir . basename($_FILES["dokumentasi"]["name"]);
        move_uploaded_file($_FILES["dokumentasi"]["tmp_name"], $dokumentasi);
    }

    $sql = "INSERT INTO monitoring_guru (guru_pembimbing, siswa_pkl, tempat_dudi, tanggal_pelaksanaan, catatan_monitoring, dokumentasi)
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssss", $guru_pembimbing, $siswa_pkl, $tempat_dudi, $tanggal_pelaksanaan, $catatan_monitoring, $dokumentasi);

    if ($stmt->execute()) {
        $success_message = "Data berhasil disimpan!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
}
?>


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
                    <h6 class="mb-0">Guru</h6>
                    <span>Online</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="dasboard_guru.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="permohonan_guru.php" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Permohonan</a>
                <a href="monitoring_guru.php" class="nav-item nav-link active"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="penarikan_guru.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>

            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <!-- Content Start -->
    <div class="content">
<nav class="navbar navbar-expand bg-light navbar-light sticky-top px-3 py-2 d-flex align-items-center" style="height: 56px;">
    <!-- Sidebar Toggler di Kiri -->
    <a href="#" class="sidebar-toggler me-auto">
        <i class="fa fa-bars"></i>
    </a>

        </nav>
        <!-- Navbar End -->

        <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="container mt-4">

                <?php if (isset($success_message)): ?>
    <div class="alert alert-success" id="notif-alert"><?= $success_message ?></div>
<?php elseif (isset($error_message)): ?>
    <div class="alert alert-danger" id="notif-alert"><?= $error_message ?></div>
<?php endif; ?>


        <form action="" method="POST" enctype="multipart/form-data">
            <div class="mb-3">
                <label class="form-label">Guru Pembimbing</label>
                <select name="guru_pembimbing" class="form-control" required>
                    <option value="">-- Pilih Guru Pembimbing --</option>
                    <?php while ($row = $pembimbing_result->fetch_assoc()): ?>
                        <option value="<?= $row['nama_pembimbing'] ?>"><?= $row['nama_pembimbing'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Nama Siswa (Setiap Nama di Baris Baru):</label>
                <textarea class="form-control" name="siswaList" rows="3" required></textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Tempat DUDI</label>
                <select name="tempat_dudi" class="form-control" required>
                    <option value="">-- Pilih Tempat DUDI --</option>
                    <?php while ($row = $dudi_result->fetch_assoc()): ?>
                        <option value="<?= $row['nama_dudi'] ?>"><?= $row['nama_dudi'] ?></option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="mb-3">
                <label class="form-label">Tanggal Pelaksanaan</label>
                <input type="date" name="tanggal_pelaksanaan" class="form-control" required>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Catatan Monitoring</label>
                <textarea name="catatan_monitoring" class="form-control" rows="3"></textarea>
            </div>
            
            <div class="mb-3">
                <label class="form-label">Dokumentasi (Gambar)</label>
                <input type="file" name="dokumentasi" class="form-control" accept="image/*">
            </div>
            
            <button type="submit" class="btn btn-outline-primary">Simpan</button>
        </form>
        </div>
            </div>
        </div>
    </div>
</div>
    
<script>
    setTimeout(function() {
        var alert = document.getElementById("notif-alert");
        if (alert) {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.style.display = "none", 500);
        }
    }, 3000); // Notif hilang dalam 3 detik
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
