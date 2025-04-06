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
                <a href="permohonan_guru.php" class="nav-item nav-link active"><i class="fa fa-th me-2"></i>Permohonan</a>
                <a href="monitoring_guru.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="penarikan_guru.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>

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
                    <span class="d-none d-lg-inline-flex">Guru</span>
                </a>
                <div class="dropdown-menu dropdown-menu-end bg-light border-0 rounded-0 rounded-bottom m-0">
                    <a href="login.php" class="dropdown-item">Keluar</a>
                </div>
            </div>
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

// Ambil nama_dudi dari URL
$id_dudi = isset($_GET['id_dudi']) ? trim($_GET['id_dudi']) : '';

$row = null;
if (!empty($id_dudi)) {
    $query = "SELECT * FROM permohonan_pkl
              WHERE permohonan_pkl.dudi_id = ?";
    
    $stmt = $conn->prepare($query);
    $stmt->bind_param("i", $id_dudi); // Gunakan "i" karena dudi_id biasanya bertipe integer
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();
}


$conn->close();
?>

<!-- <?php if ($row): ?>
    <p>Data ditemukan: <?= htmlspecialchars($row["nama_dudi"]) ?></p>
<?php else: ?>
    <div class="alert alert-warning" role="alert">
        Data tidak ditemukan. Pastikan nama_dudi sudah benar.
    </div>
<?php endif; ?> -->

<div id="surat" class="card p-4 text-dark">
    <div class="row">
        <div class="col-2">
            <img src="img/jatim.png" alt="Logo" style="width: 100px;">
        </div>
        <div class="col-10 text-center">
            <h5 class="fw-normal">PEMERINTAH PROVINSI JAWA TIMUR</h5>
            <h6 class="fw-normal">DINAS PENDIDIKAN</h6>
            <h6 class="fw-normal">SMK NEGERI 2 BANGKALAN</h6>
            <h6 class="fw-normal">NPSN/NSS: 20531223 / 321052901002</h6>
            <p>Jalan. Halim Perdana Kusuma, Bangkalan, Jawa Timur 69116</p>
            <p>Telepon (031) 3092223, Email: smkn2_bkl@yahoo.com</p>
        </div>
    </div>
    <div style="height: 3px; background-color: black; width:100%;"></div>

    <p class="text-end">Bangkalan, <?= date("d F Y") ?></p>
    <p>Nomor: <?= htmlspecialchars($row["nomor_surat"] ?? "-") ?></p>
    <p>Hal: Permohonan Praktik Kerja Lapangan</p>
    <p>Lampiran: - </p>

    <p><strong>Yth : Pimpinan / Direktur</strong></p>
    <p><strong><?= htmlspecialchars($row["tempat_pkl"] ?? "-") ?></strong></p>
    <p><?= nl2br(htmlspecialchars($row["alamat_pkl"] ?? "-")) ?></p>

    <p><em>Assalamu'alaikum Wr. Wb.</em></p>
    <p>Dengan Hormat,</p>

    <p>
        Berdasarkan kurikulum merdeka dilaksanakan selama <strong>6 bulan</strong>, untuk itu kami mohon dengan sangat agar
        Bapak/Ibu Pimpinan <strong><?= htmlspecialchars($row["tempat_pkl"] ?? "-") ?></strong> berkenan menerima siswa kami untuk melaksanakan PKL:
    </p>

    <p><strong>Konsentrasi Keahlian:</strong> <?= htmlspecialchars($row["konsentrasi_keahlian"] ?? "Tidak tersedia") ?></p>

    <?php if (!empty($row["siswa"])): ?>
    <table class="table table-bordered">
        <thead>
            <tr class="text-dark">
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            <?php
            $siswaList = explode("\n", trim($row["siswa"]));
            $no = 1;
            foreach ($siswaList as $siswa) {  
                $data = explode(",", trim($siswa));
                $nama = isset($data[0]) ? htmlspecialchars($data[0]) : '-';
                $nisn = isset($data[1]) ? htmlspecialchars($data[1]) : '-';
                
                echo "<tr><td>$no</td><td>$nama</td><td>$nisn</td></tr>";
                $no++;
            }
            ?>
        </tbody>
    </table>

    <p>
        Jika berkenan, kami berharap PKL ini dapat dilaksanakan mulai tanggal <strong><?= htmlspecialchars($row["tanggal_mulai"]) ?></strong> 
        sampai dengan tanggal <strong><?= htmlspecialchars($row["tanggal_berakhir"]) ?></strong>.
        Kami mengharapkan jawaban/informasi mengenai waktu dan durasi pelaksanaan PKL agar dapat kami koordinasikan lebih lanjut.
        Atas perhatian dan kerja sama yang diberikan, kami ucapkan terima kasih.
    </p>
    <p><em>Wassalamu'alaikum Wr. Wb.</em></p>

    <div class="text-end">
        <p>Hormat Kami,</p>
        <p>Kepala SMK Negeri 2 Bangkalan</p>
        <br><br><br>
        <p><strong>Nur Hazizah, S.Pd., M.Pd.</strong></p>
    </div>
<?php else: ?>
    <p><em>Belum ada data siswa.</em></p>
<?php endif; ?>

</div>

</body>
</html>

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