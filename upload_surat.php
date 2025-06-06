<?php
session_start();
require_once __DIR__ . '/config.php'; // Koneksi ke database

$success_message = $error_message = "";
$file_surat = "";

// Ambil daftar DUDI
$dudi_list = [];
$result_dudi = $conn->query("SELECT id, nama_dudi FROM data_dudi ORDER BY nama_dudi ASC");
while ($row = $result_dudi->fetch_assoc()) {
    $dudi_list[] = $row;
}

// Proses upload jika tombol submit ditekan
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit_upload"])) {
    $id_dudi = $_POST["id"] ?? "";

    if (empty($id_dudi)) {
        $error_message = "Pilih Nama DUDI!";
    } elseif (!empty($_FILES["file_surat"]["name"])) {
        // Ambil nama_dudi dari id
        $stmt_dudi = $conn->prepare("SELECT nama_dudi FROM data_dudi WHERE id = ?");
        $stmt_dudi->bind_param("i", $id_dudi);
        $stmt_dudi->execute();
        $stmt_dudi->bind_result($nama_dudi);
        $stmt_dudi->fetch();
        $stmt_dudi->close();

        $target_dir = "uploads/surat_permohonan/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $file_name = basename($_FILES["file_surat"]["name"]);
        $file_extension = pathinfo($file_name, PATHINFO_EXTENSION);
        $allowed_extensions = ["jpg", "jpeg", "png"];

        if (in_array(strtolower($file_extension), $allowed_extensions)) {
            $new_file_name = time() . "_" . $file_name;
            $file_path = $target_dir . $new_file_name;

            if (move_uploaded_file($_FILES["file_surat"]["tmp_name"], $file_path)) {
                // Simpan ke database
                $stmt_upload = $conn->prepare("INSERT INTO upload_surat (id, nama_dudi, file_surat) VALUES (?, ?, ?)");
                $stmt_upload->bind_param("iss", $id_dudi, $nama_dudi, $new_file_name);

                if ($stmt_upload->execute()) {
                    $success_message = "Surat berhasil diunggah!";
                } else {
                    $error_message = "Gagal menyimpan ke database.";
                }
                $stmt_upload->close();
            } else {
                $error_message = "Gagal mengunggah file.";
            }
        } else {
            $error_message = "Format file tidak didukung (JPG, JPEG, PNG).";
        }
    } else {
        $error_message = "Silakan pilih file untuk diunggah.";
    }
}

// Ambil data untuk ditampilkan di tabel
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
<div class="sidebar pe-4 pb-3 bg-light position-fixed h-100 overflow-auto" style="width: 250px; z-index: 1040;">
    <nav class="navbar navbar-light">
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

<div class="content">
    <!-- Navbar Start -->
    <nav class="navbar navbar-expand bg-light navbar-light sticky-top px-4 py-0" style="height: 56px;">
        <!-- Tombol Kembali (pojok kiri) -->
        <button onclick="history.back()" class="btn btn-secondary px-3 py-2">
            Kembali
        </button>
    </nav>

        </nav> 


        <div class="container mt-5">
    <h2 class="text-center">Upload Surat Permohonan</h2>

    <!-- Notifikasi -->
    <?php if ($success_message): ?>
        <div id="alert-success" class="alert alert-success"><?= $success_message; ?></div>
    <?php elseif ($error_message): ?>
        <div id="alert-error" class="alert alert-danger"><?= $error_message; ?></div>
    <?php endif; ?>

    <!-- Form Upload -->
    <form action="" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="nama_dudi" class="form-label">Pilih DUDI</label>
            <select name="id" id="nama_dudi" class="form-control" required>
                <option value="">-- Pilih DUDI --</option>
                <?php foreach ($dudi_list as $dudi): ?>
                    <option value="<?= $dudi['id']; ?>"><?= $dudi['nama_dudi']; ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Unggah Surat (JPG, JPEG, PNG)</label>
            <input type="file" name="file_surat" class="form-control" accept=".jpg,.jpeg,.png" required>
        </div>
        <button type="submit" name="submit_upload" class="btn btn-primary w-100">Unggah</button>
    </form>

    <!-- Tabel Data -->
    <div class="mt-5">
        <h4 class="text-center">Daftar Surat yang Diunggah</h4>
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

<script>
    setTimeout(() => {
        document.querySelectorAll(".alert").forEach(alert => {
            alert.style.transition = "opacity 0.5s";
            alert.style.opacity = "0";
            setTimeout(() => alert.remove(), 500);
        });
    }, 3000);
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