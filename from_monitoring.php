<?php
session_start();
// Gunakan path absolut atau relatif yang benar
require_once __DIR__ . '/config.php';

$message = '';  // Inisialisasi variabel message

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nomor_surat = $_POST['nomorSurat'];
    $nama_guru = $_POST['namaGuru'];
    $nip_guru = $_POST['nipGuru'];
    $jabatan_guru = $_POST['jabatanGuru'];
    $tempat_pkl = $_POST['tempatPkl']; // Menggunakan ID DU/DI
    $alamat_pkl = $_POST['alamatPkl'];
    $tanggal_surat = $_POST['tanggalSurat'];
    $konsentrasi_keahlian = $_POST['konsentrasiKeahlian'];
    $siswa_id = $_POST['siswa_id'];

    // Query insert
    $sql = "INSERT INTO monitoring_pkl (nomor_surat, nama_guru, nip_guru, jabatan_guru, tempat_pkl, 
            alamat_pkl, tanggal_surat, konsentrasi_keahlian, siswa_id) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nomor_surat, $nama_guru, $nip_guru, $jabatan_guru, $tempat_pkl, 
                      $alamat_pkl, $tanggal_surat, $konsentrasi_keahlian, $siswa_id);

    if ($stmt->execute()) {
        $message = '<div class="alert alert-success">Data berhasil disimpan!</div>';
        $last_id = $stmt->insert_id;
        $stmt->close();
        header("Location: surat_monitoring.php?id=" . $last_id);
        exit();
    } else {
        $message = '<div class="alert alert-danger">Error: ' . $stmt->error . '</div>';
    }
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
    <!-- <div id="spinner" class="show bg-white position-fixed translate-middle w-100 vh-100 top-50 start-50 d-flex align-items-center justify-content-center">
        <div class="spinner-border text-primary" style="width: 3rem; height: 3rem;" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div> -->
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
                <a href="form_permohonan.php" class="nav-item nav-link"><i class="fa-solid fa-th me-2"></i>Surat Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link active"><i class="fa-solid fa-eye me-2"></i>Surat Monitoring</a>
                <a href="from_penarikan.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Surat Penarikan</a>
                <a href="form_surattugas.php" class="nav-item nav-link"><i class="fa-solid fa-envelope-open-text me-2"></i>Surat Tugas</a>
                <a href="form_pengantar.php" class="nav-item nav-link"><i class="fa-solid fa-comment me-2"></i>Surat Pengantar</a>
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
    <a href="data_monitoring.php" class="btn btn-primary btn-sm px-3">
        Lihat Data
    </a>
</nav>
<!-- Navbar End -->
        
<?php
// Ambil data DU/DI
$sqlDudi = "SELECT id, nama_dudi, alamat FROM data_dudi";
$resultDudi = $conn->query($sqlDudi);

// Ambil data pembimbing dari tabel data_pembimbing
$sqlPembimbing = "SELECT nama_pembimbing FROM data_pembimbing";
$resultPembimbing = $conn->query($sqlPembimbing);

// Ambil data siswa dari database
$sql_siswa = "SELECT id, nama_siswa, nisn FROM siswa";
$result_siswa = $conn->query($sql_siswa);
?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="container mt-4">
                    <h2 class="text-center">Formulir Surat Monitoring</h2>
                    <?php
                    if(isset($_SESSION['error'])) {
                        echo '<div class="alert alert-danger">' . $_SESSION['error'] . '</div>';
                        unset($_SESSION['error']);
                    }
                    if(isset($_SESSION['success'])) {
                        echo '<div class="alert alert-success">' . $_SESSION['success'] . '</div>';
                        unset($_SESSION['success']);
                    }
                    ?>
                    <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="mb-3">
                            <label class="form-label">Nomor Surat:</label>
                            <input type="text" class="form-control" name="nomorSurat" required>
                        </div>
                        <div class="mb-3">
    <label class="form-label">Nama Guru Pembimbing:</label>
    <select class="form-select" name="namaGuru" required>
        <option selected disabled>Pilih Guru Pembimbing</option>
        <?php 
        // Pastikan query mengambil id dan nama_pembimbing
        $sqlPembimbing = "SELECT id, nama_pembimbing FROM data_pembimbing";
        $resultPembimbing = $conn->query($sqlPembimbing); 
        while ($row = $resultPembimbing->fetch_assoc()) { ?>
            <option value="<?= htmlspecialchars($row['id']); ?>">
                <?= htmlspecialchars($row['nama_pembimbing']); ?>
            </option>
        <?php } ?>
    </select>
</div>

                        <div class="mb-3">
                            <label class="form-label">NIP:</label>
                            <input type="text" class="form-control" name="nipGuru" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Jabatan:</label>
                            <input type="text" class="form-control" name="jabatanGuru" required>
                        </div>
                        <div class="mb-3">
    <label class="form-label">Tempat PKL (DU/DI):</label>
    <select class="form-select" name="tempatPkl" id="tempatPkl" required>
        <option selected disabled>Pilih DU/DI</option>
        <?php while ($row = $resultDudi->fetch_assoc()) { ?>
            <option 
                value="<?= htmlspecialchars($row['id']); ?>" 
                data-alamat="<?= htmlspecialchars($row['alamat']); ?>">
                <?= htmlspecialchars($row['nama_dudi']); ?>
            </option>
        <?php } ?>
    </select>
</div>

<div class="mb-3">
    <label class="form-label">Alamat PKL:</label>
    <textarea class="form-control" name="alamatPkl" id="alamatPkl" rows="2" readonly required></textarea>
</div>

                        <div class="mb-3">
                            <label class="form-label">Konsentrasi Keahlian:</label>
                            <input type="text" class="form-control" name="konsentrasiKeahlian" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Surat:</label>
                            <input type="date" class="form-control" name="tanggalSurat" required>
                        </div>
                            <div class="mb-3">
                                <label class="form-label">Nama, NISN, dan Semester/Tingkat Siswa:</label>
                                <select class="form-control" name="siswa_id" id="namaSiswa" required>
                                    <option value="">Pilih Siswa</option>
                                    <?php while ($row_siswa = $result_siswa->fetch_assoc()) : ?>
                                        <option value="<?= $row_siswa['id'] ?>" data-nisn="<?= $row_siswa['nisn'] ?>">
                                            <?= htmlspecialchars($row_siswa['nama_siswa']) ?> - <?= $row_siswa['nisn'] ?> - XII/1
                                        </option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        <button type="submit" class="btn btn-primary">Buat Surat</button>
                    </form>
                    <?= $message; ?> <!-- Menampilkan pesan error atau sukses -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- JavaScript untuk mengisi alamat PKL otomatis -->
<script>
document.getElementById("tempatPkl").addEventListener("change", function() {
    var alamat = this.options[this.selectedIndex].getAttribute("data-alamat");
    document.getElementById("alamatPkl").value = alamat;
});
</script>
    `



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

