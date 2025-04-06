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
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sipraka";

// Aktifkan error report untuk debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Koneksi
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil data berdasarkan ID
$id = $_GET['id'] ?? null;
if (!$id) {
    die("ID tidak ditemukan.");
}

$query = "SELECT * FROM siswa WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

if (!$row) {
    die("Data tidak ditemukan.");
}

// Simpan perubahan data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['nama'];
    $jurusan = $_POST['jurusan'];
    $du_di = $_POST['du_di'];

    $updateQuery = "UPDATE siswa SET nama_siswa = ?, jurusan = ?, du_di = ? WHERE id = ?";
    $stmt = $conn->prepare($updateQuery);
    $stmt->bind_param("sssi", $nama, $jurusan, $du_di, $id);

    if ($stmt->execute()) {
        echo "<script>alert('Data berhasil diperbarui!'); window.location='data_siswa.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
}
?>

<body>
    <div class="container-xxl position-relative bg-white d-flex p-0">
        <!-- Spinner Start -->
        <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
            <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
                <span class="sr-only">Loading...</span>
            </div>
        </div>
        <!-- Spinner End -->


        <div class="container-xxl position-relative bg-white d-flex p-0">
    
    <!-- Sidebar Start -->
    <div class="sidebar pe-4 pb-3">
        <nav class="navbar bg-light navbar-light">
            <a href="dasboard_admin.php" class="navbar-brand mx-4 mb-3">
                <h3 class="text-primary">SIPRAKA</h3>
            </a>

            <div class="d-flex align-items-center ms-4 mb-4">
                <div class="position-relative">
                    <img class="rounded-circle" src="img/foto.jpg" alt="Admin" style="width: 40px; height: 40px;">
                    <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                </div>
                <div class="ms-3">
                    <h6 class="mb-0">Admin</h6>
                    <span>Online</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="dasboard_admin.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="tambahdata_admin.php" class="nav-item nav-link active"><i class="fa-solid fa-calendar-plus me-2"></i>Tambah Data</a>
                <a href="form_permohonan.php" class="nav-item nav-link"><i class="fa-solid fa-th me-2"></i>Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="from_penarikan.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                <a href="form_surattugas.php" class="nav-item nav-link"><i class="fa-solid fa-envelope-open-text me-2"></i>Surat Tugas</a>
                <a href="form_pengantar.php" class="nav-item nav-link"><i class="fa-solid fa-comment me-2"></i>Surat Pengantar</a>
                <a href="absensi_admin.php" class="nav-item nav-link"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->

    <div class="content">
        
        <!-- Navbar Start -->
        <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-2 shadow">
            <button onclick="history.back()" class="btn btn-secondary px-3 py-2">Kembali</button>
        </nav>
        <!-- Navbar End -->

        



        <div class="container-fluid pt-4 px-4">
                    <div class="row g-4">
                        <div class="col-12">
                            <div class="bg-light rounded h-100 p-4">
                                <h2 class="mb-4">Edit Data Du/Di</h2>
                                <div class="card">
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa</label>
                            <input type="text" class="form-control" name="nama" value="<?= htmlspecialchars($row['nama_siswa'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jurusan</label>
                            <input type="text" class="form-control" name="jurusan" value="<?= htmlspecialchars($row['jurusan'] ?? '') ?>" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Du/Di</label>
                            <input type="text" class="form-control" name="du_di" value="<?= htmlspecialchars($row['du_di'] ?? '') ?>" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary me-2">Simpan Perubahan</button>
                            <a href="data_siswa.php" class="btn btn-secondary">Batal</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




 




<!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
            <div class="bg-light rounded-top p-4 text-center">
                <p class="mb-0">&copy; 2025 <a href="#">SIPRAKA</a>, All Right Reserved.</p>
            </div>
        </div>
        <!-- Footer End -->

    </div>
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
