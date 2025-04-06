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
 <!-- Content Start -->
 <div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0" style="height: 56px;">
        <!-- Tombol Kembali (pojok kiri) -->
        <button onclick="history.back()" class="btn btn-secondary px-3 py-2">
            Kembali
        </button>

        <div class="ms-auto">
            <!-- Tombol Lihat Data (pojok kanan) -->
            <a href="lihatdata_guru.php" class="btn btn-primary px-3 py-2">
                Lihat Data
            </a>
        </div>
    </nav>

        </nav>
        <!-- Navbar End -->

        
        <?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_sipraka";

// Koneksi ke database
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Ambil daftar Du/Di dari database
$sql_du_di = "SELECT id, nama_dudi FROM data_dudi";
$result_du_di = $conn->query($sql_du_di);

$message = "";

// Jika form disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama_pembimbing = $_POST['nama']; // Sesuai dengan name di input form
    $jurusan = $_POST['jurusan'];
    $du_di = $_POST['du_di']; // ID Du/Di dari dropdown

    // Simpan data ke tabel data_pembimbing
    $stmt = $conn->prepare("INSERT INTO data_pembimbing (nama_pembimbing, jurusan, du_di) VALUES (?, ?, ?)");
    $stmt->bind_param("ssi", $nama_pembimbing, $jurusan, $du_di);

    if ($stmt->execute()) {
        $message = "<div class='alert alert-success mt-3'>Data berhasil disimpan.</div>";
    } else {
        $message = "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
}

$conn->close();
?>

<!-- Form Input -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Data Pembimbing</h6>
                <form action="" method="POST">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="namaInput" name="nama" placeholder="Masukkan Nama" required>
                        <label for="namaInput">Nama Pembimbing</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jurusanSelect" name="jurusan" required>
                            <option selected disabled>Pilih Jurusan</option>
                            <option value="XII DPIB">DPIB</option>
                            <option value="XII TITL">TITL</option>
                            <option value="XII TPM 1">TPM</option>
                            <option value="XII TBSM 1">TBSM</option>
                            <option value="XII TKRO 2">TKRO</option>
                            <option value="XII TKJ 1">TKJ</option>
                            <option value="XII RPL 2">RPL</option>
                            <option value="XII KI">KI</option>
                        </select>
                        <label for="jurusanSelect">Jurusan</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select" id="duDiSelect" name="du_di" required>
                            <option selected disabled>Pilih Du/Di</option>
                            <?php while ($row = $result_du_di->fetch_assoc()) : ?>
                                <option value="<?= $row['id']; ?>"><?= htmlspecialchars($row['nama_dudi']); ?></option>
                            <?php endwhile; ?>
                        </select>
                        <label for="duDiSelect">Nama Du/Di</label>
                    </div>
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Simpan</button>
                    </div>
                </form>
                <?= $message; ?> <!-- Menampilkan pesan sukses atau error -->
            </div>
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