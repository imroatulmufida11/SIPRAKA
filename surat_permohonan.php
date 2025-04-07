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
                <a href="form_permohonan.php" class="nav-item nav-link active"><i class="fa-solid fa-th me-2"></i>Surat Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Surat Monitoring</a>
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

        <?php
include 'config.php';

if (!isset($_GET["id"]) || !is_numeric($_GET["id"])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = intval($_GET["id"]);

// Query untuk mengambil data surat permohonan PKL
$sql = "SELECT p.*, 
               COALESCE(NULLIF(p.tempat_pkl, ''), d.nama_dudi) AS tempat_pkl_final,
               COALESCE(NULLIF(p.alamat_pkl, ''), d.alamat) AS alamat_pkl_final
        FROM permohonan_pkl p
        LEFT JOIN data_dudi d ON p.tempat_pkl = d.id
        WHERE p.id = $id";

$result = mysqli_query($conn, $sql);

if (!$row = mysqli_fetch_assoc($result)) {
    echo "Data tidak ditemukan!";
    exit;
}
?>

<div class="container mt-4">
    <button class="btn btn-primary btn-print mb-3" onclick="printSurat()">🖨 Cetak Surat</button>
    <div id="surat" class="card p-4 text-dark">
        <div class="row">
            <div class="col-2">
                <img src="img/jatim.png" alt="Logo" style="width: 90px;">
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
        <table>
            <tr><td>No.</td> <td>: <?= htmlspecialchars($row["nomor_surat"]) ?></td></tr>
            <tr><td>Hal</td> <td>: Permohonan Praktik Kerja Lapangan</td></tr>
            <tr><td>Lamp</td> <td>: -</td></tr>
        </table>

        <br>

        <table>
            <tr><td><strong>Yth</strong></td> <td>: <strong>Pimpinan / Direktur</strong></td></tr>
            <tr><td></td> <td><strong><?= htmlspecialchars($row["tempat_pkl_final"]) ?></strong></td></tr>
            <tr><td></td> <td><?= nl2br(htmlspecialchars($row["alamat_pkl_final"])) ?></td></tr>
        </table>

        <p class="mt-3"><em>Assalamu'alaikum Wr. Wb.</em></p>
        <p>Dengan Hormat,</p>

        <p>
            Dalam penyelenggaraan sistem pendidikan tingkat kejuruan, disamping siswa harus melaksanakan
            Kegiatan Belajar Mengajar (KBM) di sekolah, siswa juga dituntut melaksanakan praktik kerja di
            Dunia Usaha / Dunia Industri, yang dikenal dengan istilah PKL (Praktik Kerja Lapangan). Berdasarkan kurikulum merdeka dilaksanakan selama <strong>6 bulan</strong>, untuk itu kami mohon dengan sangat agar
            Bapak/Ibu Pimpinan <strong><?= htmlspecialchars($row["tempat_pkl_final"]) ?></strong> berkenan menerima siswa kami untuk
            melaksanakan PKL:
        </p>
        
        <p><strong>Konsentrasi Keahlian:</strong> <?= htmlspecialchars($row["konsentrasi_keahlian"]) ?></p>

        <?php if (!empty(trim($row["siswa"]))): ?>
            <table class="table table-bordered" mt-4 style="border: 100px;">
                <thead>
                    <tr class="text-dark">
                        <th>No</th>
                        <th>Nama</th>
                        <th>NISN</th>
                        <th>Semester/Tingkat</th>
                    </tr>
                </thead>
                <tbody class="text-dark">
                    <?php
                    $siswaList = explode("\n", trim($row["siswa"]));
                    $no = 1;
                    foreach ($siswaList as $siswa) {  
                        $data = array_map('trim', explode(",", $siswa));
                        if (count($data) >= 2) {
                            echo "<tr>
                                    <td>$no</td>
                                    <td>" . htmlspecialchars($data[0]) . "</td>
                                    <td>" . htmlspecialchars($data[1]) . "</td>
                                    <td>" . (isset($data[2]) ? htmlspecialchars($data[2]) : '-') . "</td>
                                  </tr>";
                            $no++;
                        }
                    }
                    ?>
                </tbody>
            </table>
        <?php else: ?>
            <p><em>Belum ada data siswa.</em></p>
        <?php endif; ?>

        <p>
            Jika berkenan, kami berharap PKL ini dapat dilaksanakan mulai tanggal <strong><?= htmlspecialchars($row["tanggal_mulai"]) ?></strong> 
            sampai dengan tanggal <strong><?= htmlspecialchars($row["tanggal_berakhir"]) ?></strong>.
            Kami mengharapkan jawaban/informasi mengenai waktu dan durasi pelaksanaan PKL agar dapat kami koordinasikan lebih lanjut.
            Atas perhatian dan kerja sama yang diberikan, kami ucapkan terima kasih.
        </p>
        <p><em>Wassalamu'alaikum Wr. Wb.</em></p>

        <div class="text-end">
    <div class="d-inline-block text-start">
        <p class="mb-1">Hormat Kami,</p>
        <p class="mb-5">Kepala SMK Negeri 2 Bangkalan</p> <!-- Tambah jarak di sini -->

        <p class="fw-bold mb-1">Nur Hazizah, S.Pd., M.Pd.</p>
        <p class="mb-1">Pembina Tk. I / IV/b</p>
        <p>NIP 196912181997032006</p>
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
