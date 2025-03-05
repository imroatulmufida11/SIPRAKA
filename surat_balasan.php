<?php
session_start();
require_once __DIR__ . '/config.php'; // Koneksi ke database

$success_message = $error_message = "";
$file_surat = "";

// Ambil daftar DUDI dari database
$dudi_list = [];
$result_dudi = $conn->query("SELECT id, nama_dudi FROM data_dudi ORDER BY nama_dudi ASC");
while ($row = $result_dudi->fetch_assoc()) {
    $dudi_list[] = $row;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_dudi = $_POST["id"] ?? "";

    if (empty($id_dudi)) {
        $error_message = "Pilih Nama DUDI!";
    } else {
        // Ambil nama_dudi berdasarkan id_dudi
        $query = $conn->prepare("SELECT nama_dudi FROM data_dudi WHERE id = ?");
        $query->bind_param("i", $id_dudi);
        $query->execute();
        $query->bind_result($nama_dudi);
        $query->fetch();
        $query->close();

        if (!$nama_dudi) {
            $error_message = "DUDI tidak ditemukan!";
        } elseif (!empty($_FILES["file_surat"]["name"])) {
            $target_dir = "uploads/surat_permohonan/";
            if (!is_dir($target_dir)) {
                mkdir($target_dir, 0777, true);
            }

            $file_extension = pathinfo($_FILES["file_surat"]["name"], PATHINFO_EXTENSION);
            $allowed_extensions = ["jpg", "jpeg", "png"];

            if (in_array(strtolower($file_extension), $allowed_extensions)) {
                $new_file_name = time() . "_" . basename($_FILES["file_surat"]["name"]);
                $file_surat = $target_dir . $new_file_name;

                if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $file_surat)) {
                    // Simpan data ke database
                    $stmt = $conn->prepare("INSERT INTO upload_surat (nama_dudi, file_surat) VALUES (?, ?)");
                    $stmt->bind_param("ss", $nama_dudi, $file_surat);

                    if ($stmt->execute()) {
                        $success_message = "Surat berhasil diunggah!";
                    } else {
                        $error_message = "Gagal menyimpan ke database: " . $stmt->error;
                    }

                    $stmt->close();
                } else {
                    $error_message = "Gagal mengunggah surat.";
                }
            } else {
                $error_message = "Format file tidak didukung! Harap unggah JPG, JPEG, atau PNG.";
            }
        } else {
            $error_message = "Silakan pilih file untuk diunggah.";
        }
    }
}


// Ambil data dari database untuk tabel tampilan
$result = $conn->query("SELECT us.*, dd.nama_dudi 
                        FROM upload_surat us
                        JOIN data_dudi dd ON us.id = dd.id
                        ORDER BY us.tanggal_upload DESC");
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
                    <h6 class="mb-0">Admin</h6>
                    <span>Online</span>
                </div>
            </div>
            <div class="navbar-nav w-100">
                <a href="dasboard_admin.php" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Dashboard</a>
                <a href="tambahdata_admin.php" class="nav-item nav-link"><i class="fa-solid fa-calendar-plus me-2"></i>Tambah Data</a>
                <a href="form_permohonan.php" class="nav-item nav-link active"><i class="fa-solid fa-th me-2"></i>Permohonan</a>
                <a href="from_monitoring.php" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                <a href="from_penarikan.php" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
                <a href="absensi_admin.php" class="nav-item nav-link"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
            </div>
        </nav>
    </div>
    <!-- Sidebar End -->
    <div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0" style="height: 56px;">
        <!-- Tombol Kembali (pojok kiri) -->
        <button onclick="history.back()" class="btn btn-secondary px-3 py-2">
            Kembali
        </button>
    </nav>

        </nav> 

 <!-- Tabel Data Surat -->
 <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
        <h4 class="text-center">Surat Balasan </h4>
        <table class="table table-bordered">
            <thead>
                <tr class="table-primary text-center">
                    <th>No</th>
                    <th>Nama DUDI</th>
                    <th>Nama File</th>
                    <th>Pratinjau</th>
                    <th>Tanggal Upload</th>
                </tr>
            </thead>
            <tbody>
                <?php if ($result->num_rows > 0): ?>
                    <?php $no = 1; while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="text-center"><?= $no++; ?></td>
                            <td><?= $row['nama_dudi']; ?></td>
                            <td><?= $row['file_surat']; ?></td>
                            <td class="text-center">
                                <img src="uploads/surat_permohonan/<?= $row['file_surat']; ?>" alt="Surat" width="100">
                            </td>
                            <td class="text-center"><?= $row['tanggal_upload']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-center">Belum ada surat yang diunggah.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div> 
 </div>
            </div>
        <!-- </div>
    </div> -->

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
