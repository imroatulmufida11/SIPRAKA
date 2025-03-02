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
    $tempat_pkl = $_POST['tempatPkl'];
    $alamat_pkl = $_POST['alamatPkl'];
    $tanggal_surat = $_POST['tanggalSurat'];
    $konsentrasi_keahlian = $_POST['konsentrasiKeahlian'];
    $siswa = $_POST['siswaList'];

    // Query insert
    $sql = "INSERT INTO monitoring_pkl (nomor_surat, nama_guru, nip_guru, jabatan_guru, tempat_pkl, 
            alamat_pkl, tanggal_surat, konsentrasi_keahlian, siswa) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssss", $nomor_surat, $nama_guru, $nip_guru, $jabatan_guru, $tempat_pkl, 
                      $alamat_pkl, $tanggal_surat, $konsentrasi_keahlian, $siswa);
    
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
                <a href="form_permohonan.php" class="nav-item nav-link active"><i class="fa-solid fa-th me-2"></i>Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="chart.html" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                <a href="chart.html" class="nav-item nav-link"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
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

        
    <?php
// Ambil data DU/DI
$sqlDudi = "SELECT id, nama_dudi, alamat FROM data_dudi";
$resultDudi = $conn->query($sqlDudi);

// Ambil data pembimbing dari tabel data_pembimbing
$sqlPembimbing = "SELECT nama_pembimbing FROM data_pembimbing";
$resultPembimbing = $conn->query($sqlPembimbing);
while ($row = $resultPembimbing->fetch_assoc()) {
     $row['nama_pembimbing'] . "</p>"; // Cek apakah semua muncul
}

//ambil data jurusan dari tabel data_pembimbing
$sqlJurusan = "SELECT jurusan FROM data_pembimbing";
$resultJurusan = $conn->query($sqlJurusan);{

}


?>

<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <div class="container mt-4">
                    <h2 class="text-center">Formulir Surat Tugas PKL</h2>
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
                                $sqlPembimbing = "SELECT nama_pembimbing FROM data_pembimbing"; // Jalankan ulang query
                                $resultPembimbing = $conn->query($sqlPembimbing); 
                                while ($row = $resultPembimbing->fetch_assoc()) { ?>
                                    <option value="<?= htmlspecialchars($row['nama_pembimbing']); ?>">
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
                            <label class="form-label">Tempat PKL:</label>
                            <select class="form-select" name="tempatPkl" id="tempatPkl" required>
                                <option selected disabled>Pilih DU/DI</option>
                                <?php while ($row = $resultDudi->fetch_assoc()) { ?>
                                    <option value="<?= htmlspecialchars($row['nama_dudi']); ?>" data-alamat="<?= htmlspecialchars($row['alamat']); ?>">
                                        <?= htmlspecialchars($row['nama_dudi']); ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Alamat PKL:</label>
                            <textarea class="form-control" name="alamatPkl" id="alamatPkl" rows="2" required readonly></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Konsentrasi Keahlian:</label>
                            <select class="form-control" name="konsentrasiKeahlian" required>
                                <option value="">Pilih Konsentrasi Keahlian</option>
                                <?php while ($rowJurusan = mysqli_fetch_assoc($resultJurusan)) : ?>
                                    <option value="<?= htmlspecialchars($rowJurusan['jurusan']) ?>">
                                        <?= htmlspecialchars($rowJurusan['jurusan']) ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Tanggal Surat:</label>
                            <input type="date" class="form-control" name="tanggalSurat" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Nama Siswa (Setiap Nama di Baris Baru):</label>
                            <textarea class="form-control" name="siswaList" rows="3" required></textarea>
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

