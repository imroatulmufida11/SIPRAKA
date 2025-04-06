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
    <a href="surat_balasan.php" class="btn btn-primary btn-sm px-3">
        Lihat Data
    </a>
</nav>
<!-- Navbar End -->

<?php
include 'config.php';

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = intval($_GET["id"]);

// Query untuk mengambil data surat pengantar
$sql = "SELECT * FROM surat_pengantar WHERE id = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);
$data = mysqli_fetch_assoc($result);

if (!$data) {
    echo "Data tidak ditemukan!";
    exit;
}

// Konversi daftar siswa dari database menjadi array
$siswa_list = [];
if (!empty($data['siswa'])) {
    $siswa_list = preg_split('/\r\n|\r|\n/', $data['siswa']);
}

// Format tanggal surat
$tanggal_surat = date("d F Y", strtotime($data['tanggal_mulai']));
?>


<!-- Tambahkan class "no-print" untuk elemen yang tidak perlu dicetak -->
<div class="container mt-4">
    <button class="btn btn-primary btn-print mb-3 no-print" onclick="printSurat()">🖨 Cetak Surat</button>

<div id="surat" class="card p-4 text-dark">
    <div class="row">
        <div class="col-2">
            <img src="img/jatim.png" alt="Logo" style="width: 90px;">
        </div>
        <div class="col-10 text-center">
            <h5>PEMERINTAH PROVINSI JAWA TIMUR</h5>
            <h6>DINAS PENDIDIKAN</h6>
            <h6>SMK NEGERI 2 BANGKALAN</h6>
            <h6>NPSN/NSS: 20531223 / 321052901002</h6>
            <p>Jalan. Halim Perdana Kusuma (Ring Road) Telp (031) 3092223 E-mail: smkn2_bkl@yahoo.com</p>
            <h6>BANGKALAN</h6>
        </div>
    </div>

    <div style="height: 3px; background-color: black; width:100%; margin-bottom: 10px;"></div>

    <p class="text-end">Bangkalan, <?= $tanggal_surat ?></p>

    <table style="width: 100%;">
        <tr>
            <td style="width: 50%; vertical-align: top;">
                <table>
                    <tr>
                        <td style="width: 100px;">No.</td>
                        <td style="width: 10px;">:</td>
                        <td><?= htmlspecialchars($data["nomor_surat"]) ?></td>
                    </tr>
                    <tr>
                        <td>Hal</td>
                        <td>:</td>
                        <td>Pengantar Praktik Kerja Lapangan</td>
                    </tr>
                </table>
            </td>
            <td style="width: 50%; vertical-align: top; text-align: left; padding-left: 15px;">
                <table>
                    <tr>
                        <td><strong>Kepada Yth</strong></td>
                    </tr>
                    <tr>
                        <td><strong>Bapak/Ibu Pimpinan</strong></td>
                    </tr>
                    <tr>
                        <td><strong><?= htmlspecialchars($data["tempat_pkl"]) ?></strong></td>
                    </tr>
                    <tr>
                        <td><?= nl2br(htmlspecialchars($data["alamat_pkl"])) ?></td>
                    </tr>
                    <tr>
                        <td>Di</td>
                    </tr>
                    <tr>
                        <td><?= nl2br(htmlspecialchars($data["kota_pkl"])) ?></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>

    <p class="mt-3"><em>Assalamu'alaikum Wr. Wb.</em></p>
    <p>Dengan Hormat,</p>
    <p>Dalam penyelenggaraan Pendidikan Sistem Ganda (PSG), disamping siswa melaksanakan kegiatan Belajar Mengajar (KBM) di sekolah, siswa juga dituntut melaksanakan KBM di Dunia Usaha/Dunia Industri, yang dikenal istilah PKL (Praktik Kerja Lapangan).
        <br>Untuk itu, sesuai dengan tujuan PKL kami mohon bimbingannya untuk siswa kami yang ditempatkan di <strong><?= htmlspecialchars($data["tempat_pkl"]) ?></strong>
    </p>

    <p class="mb-0"><strong>Konsentrasi Keahlian: </strong><?= htmlspecialchars($data['konsentrasi_keahlian']) ?></p>
    
    <table class="table table-bordered mt-0">
        <thead>
            <tr class="text-dark">
                <th>No</th>
                <th>Nama Siswa</th>
                <th>NISN</th>
                <th>Tingkat / Semester</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            <?php if (!empty($siswa_list)): ?>
                <?php foreach ($siswa_list as $index => $siswa): ?>
                    <?php $siswa_data = explode(",", trim($siswa)); ?>
                    <tr>
                        <td><?= $index + 1 ?></td>
                        <td><?= isset($siswa_data[0]) ? htmlspecialchars(trim($siswa_data[0])) : '' ?></td>
                        <td><?= isset($siswa_data[1]) ? htmlspecialchars(trim($siswa_data[1])) : '' ?></td>
                        <td><?= isset($siswa_data[2]) ? htmlspecialchars(trim($siswa_data[2])) : '' ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4">Tidak ada data siswa</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <p>Pelaksanaan Praktek Kerja Lapangan ini akan dimulai tanggal <strong><?= htmlspecialchars($data["tanggal_mulai"]) ?></strong> hingga <strong><?= htmlspecialchars($data["tanggal_berakhir"]) ?></strong>. Demi kelancaran serta efektivitas program, kami menunjuk salah seorang dari staf/karyawan sebagai pembimbing siswa selama Praktek Kerja Lapangan berlangsung. 
    <br>Demikian surat pengantar ini, atas perhatian dan kerjasama yang terjalin selama ini kami sampaikan terima kasih.</p>

    <p><em>Wassalamu'alaikum Wr. Wb.</em></p>

    <div class="text-end">
        <div class="d-inline-block text-start">
            <p class="mb-1">Hormat Kami,</p>
            <p class="mb-5">Kepala SMK Negeri 2 Bangkalan</p>
            <p class="fw-bold mb-1">Nur Hazizah, S.Pd., M.Pd.</p>
            <p class="mb-1">Pembina Tk. I / IV/b</p>
            <p>NIP 196912181997032006</p>
        </div>
    </div>
</div>

<style>
        @media print {
            body {
                margin: 0;
                padding: 0;
            }

            body * {
                visibility: hidden; /* Sembunyikan semua elemen */
            }

            #surat, #surat * {
                visibility: visible; /* Tampilkan hanya bagian surat */
            }

            #surat {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100vh; /* Paksa tinggi sesuai layar */
                page-break-before: avoid;
                page-break-after: avoid;
                page-break-inside: avoid;
            }

            table {
                page-break-inside: avoid; /* Cegah tabel terpotong */
            }

            * {
                font-size: 12px !important; /* Kecilkan font biar muat */
            }
        }
    </style>

<script>
function printSurat() {
    window.print();
}
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