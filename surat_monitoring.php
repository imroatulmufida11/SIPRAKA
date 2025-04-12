<?php
session_start();
require_once __DIR__ . '/config.php';

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid");
}

$id = $_GET['id'];

// Ambil data dari monitoring_pkl
$sql = "SELECT * FROM monitoring_pkl WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan");
}

$data = $result->fetch_assoc();

// Ambil data guru dari ID
$guru_id = $data['nama_guru'];
$nama_guru = "-";
$nip_guru = "-";
$jabatan_guru = "-";

$sql_guru = "SELECT nama_pembimbing FROM data_pembimbing WHERE id = ?";
$stmt_guru = $conn->prepare($sql_guru);
$stmt_guru->bind_param("i", $guru_id);
$stmt_guru->execute();
$result_guru = $stmt_guru->get_result();

if ($result_guru->num_rows > 0) {
    $guru_data = $result_guru->fetch_assoc();
    $nama_guru = $guru_data['nama_pembimbing'];
}

// Ambil data tempat_pkl dari tabel monitoring_pkl
$tempat_pkl = $data['tempat_pkl']; // Pastikan kolom ini ada di tabel monitoring_pkl

// Ambil nama DUDI dari ID tempat_pkl
$id_dudi = $data['tempat_pkl'];
$nama_dudi = "-";

$sql_dudi = "SELECT nama_dudi FROM data_dudi WHERE id = ?";
$stmt_dudi = $conn->prepare($sql_dudi);
$stmt_dudi->bind_param("i", $id_dudi);
$stmt_dudi->execute();
$result_dudi = $stmt_dudi->get_result();

if ($result_dudi->num_rows > 0) {
    $dudi_data = $result_dudi->fetch_assoc();
    $nama_dudi = $dudi_data['nama_dudi'];
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

        <div class="container mt-4">
<button class="btn btn-primary btn-print mb-3" onclick="printSurat()">🖨 Cetak Surat</button>

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
                <p>Jalan. Halim Perdana Kusuma, Bangkalan, Jawa Timur 69116</p>
                <p>Telepon (031) 3092223, Email: smkn2_bkl@yahoo.com</p>
            </div>
            <div style="height: 3px; background-color: black; width:100%;"></div>
        <hr>
        
        <h5 class="text-center"><u>SURAT TUGAS</u></h5>
        <p class="text-center">Nomor: <?= htmlspecialchars($data['nomor_surat']) ?></p>
        
        <p>Yang bertanda tangan di bawah ini, Kepala SMK Negeri 2 Bangkalan dengan ini:</p>
        <h6 class="text-center"><strong>MENUGASKAN</strong></h6>
        
        <!-- <h4 class="text-center fw-bold">MENUGASKAN</h4> -->

<table>
    <tr>
        <td style="width: 80px;">Kepada</td>
        <td style="width: 10px;">:</td>
        <td style="width: 80px;">Nama</td>
        <td style="width: 10px;">:</td>
        <td><?= htmlspecialchars($nama_guru) ?></td>    
    <tr>
        <td></td>
        <td></td>
        <td>NIP</td>
        <td>:</td>
        <td><?= htmlspecialchars($data['nip_guru']) ?></td>
    </tr>
    <tr>
        <td></td>
        <td></td>
        <td>Jabatan</td>
        <td>:</td>
        <td><?= htmlspecialchars($data['jabatan_guru']) ?></td>
    </tr>
</table>

<br>

<table>
    <tr>
        <td style="width: 80px;">Untuk</td>
        <td style="width: 10px;">:</td>
        <td>Monitoring siswa PKL ke <strong><?= htmlspecialchars($nama_dudi) ?></strong></td>
    </tr>

    <tr>
    <td></td>
    <td></td>
    <td>
    <?= nl2br(htmlspecialchars($data['alamat_pkl'])) ?> 
    <span style="margin-left: 20px;">pada tanggal</span> 
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
    <strong><?= date("F Y", strtotime($data['tanggal_surat'])) ?></strong>
</td>

</tr>

</table>

       <p class="mt-3 mb-2"><strong>Konsentrasi Keahlian:</strong> <?= htmlspecialchars($data['konsentrasi_keahlian']) ?></p>


        <!-- Tabel Siswa -->
        <?php
$siswa_data = [];

if (!empty(trim($data["siswa_id"]))) {
    $siswa_ids = array_map('intval', explode(",", $data["siswa_id"]));
    $id_list = implode(",", $siswa_ids);

    $sql_siswa = "SELECT nama_siswa, nisn FROM siswa WHERE id IN ($id_list)";
    $result_siswa = mysqli_query($conn, $sql_siswa);

    if ($result_siswa) {
        while ($siswa = mysqli_fetch_assoc($result_siswa)) {
            $siswa_data[] = $siswa;
        }
    }
}

?>

<?php if (!empty($siswa_data)): ?>
    <table class="table table-bordered mt-4">
        <thead>
            <tr class="text-dark">
                <th>No</th>
                <th>Nama</th>
                <th>NISN</th>
                <th>Semester/Tingkat</th>
            </tr>
        </thead>
        <tbody class="text-dark">
            <?php $no = 1; foreach ($siswa_data as $siswa): ?>
                <tr>
                    <td><?= $no++; ?></td>
                    <td><?= htmlspecialchars($siswa["nama_siswa"]); ?></td>
                    <td><?= htmlspecialchars($siswa["nisn"]); ?></td>
                    <td>XII/1</td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p><em>Belum ada data siswa.</em></p>
<?php endif; ?>

       <!-- Tanda Tangan -->
<div class="row mt-5">
    <!-- Bagian Kiri -->
    <div class="col-6 text-start">
        <p>Telah diketahui oleh:</p>
        <p><strong>Pihak DU/DI</strong></p>
        <br><br><br>
        <p>.................................</p>
        <p>(Nama Terang + Tanda tangan + Stempel)</p>
    </div>

    <!-- Bagian Kanan -->
    <div class="col-6 d-flex justify-content-end"> <!-- Tetap di pojok kanan -->
        <div class="text-start"> <!-- Agar teks tetap rata kiri -->
            <p>Bangkalan, <?= date("d F Y", strtotime($data['tanggal_surat'])) ?></p>
            <p>Kepala SMK Negeri 2 Bangkalan</p>
            <br><br><br> <!-- Jarak untuk tanda tangan -->
            <p class="fw-bold mb-1">Nur Hazizah, S.Pd., M.Pd.</p>
            <p class="mb-1">Pembina Tk. I / IV/b</p>
            <p>NIP 196912181997032006</p>
        </div>
    </div>
</div>



        </div>
    </div>

    <head>
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
        table.table-bordered th, 
    table.table-bordered td {
        border: 1px solid #000 !important;
    }

    table.table-bordered th {
        background-color: #f2f2f2;
        font-weight: bold;
    }

    table.table-bordered td {
        font-weight: 500;
}

    </style>
</head>


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
