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
                <a href="index.html" class="navbar-brand mx-5 mb-4">
                    <h3 class="text-primary"> SIPRAKA</h3>
                </a>
                <div class="d-flex align-items-center ms-4 mb-4">
                    <div class="position-relative">
                        <img class="rounded-circle" src="img/admin.jpg" alt="" style="width: 40px; height: 40px;">
                        <div class="bg-success rounded-circle border border-2 border-white position-absolute end-0 bottom-0 p-1"></div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0">Jhon Doe</h6>
                        <span>Admin</span>
                    </div>
                </div>
                <div class="navbar-nav w-100">
                    <a href="index.html" class="nav-item nav-link"><i class="fa fa-tachometer-alt me-2"></i>Beranda</a>
                    <div class="nav-item dropdown">
                    </div>
                    <a href="widget.html" class="nav-item nav-link"><i class="fa fa-th me-2"></i>Permohonan</a>
                    <a href="absensisiswa.php" class="nav-item nav-link active"><i class="fa-solid fa-pen me-2"></i>Absensi</a>
                    <a href="table.html" class="nav-item nav-link"><i class="fa-solid fa-eye me-2"></i>Monitoring</a>
                    <a href="chart.html" class="nav-item nav-link"><i class="fa-solid fa-hand-holding-heart me-2"></i>Penarikan</a>
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
                
                              
            </nav>
            <!-- Navbar End -->


            <!-- Form Start -->
       <!-- Form Start -->
<div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h6 class="mb-4">Absensi</h6>
                <form action="absensisiswa.php" method="POST">
                    <!-- Input Nama -->
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="namaInput" name="nama" placeholder="Masukkan Nama" required>
                        <label for="namaInput">Nama   </label>
                    </div>
                    <!-- Input Tanggal -->
                    <div class="form-floating mb-3">
                        <input type="date" class="form-control" id="tanggalInput" name="tanggal" required>
                        <label for="tanggalInput">Tanggal</label>
                    </div>
                    <!-- Pilihan Jurusan -->
                    <div class="form-floating mb-3">
                        <select class="form-select" id="jurusanSelect" name="jurusan" required>
                            <option selected disabled>Pilih Jurusan</option>
                            <option value="XII DPIB">XII DPIB</option>
                            <option value="XII TITL">XII TITL</option>
                            <option value="XII TPM 1">XII TPM 1</option>
                            <option value="XII TPM 2">XII TPM 2</option>
                            <option value="XII TBSM 1">XII TBSM 1</option>
                            <option value="XII TBSM 2">XII TBSM 2</option>
                            <option value="XII TKRO 1">XII TKRO 1</option>
                            <option value="XII TKRO 2">XII TKRO 2</option>
                            <option value="XII TKJ 1">XII TKJ 1</option>
                            <option value="XII TKJ 2">XII TKJ 2</option>
                            <option value="XII RPL 1">XII RPL 1</option>
                            <option value="XII RPL 2">XII RPL 2</option>
                            <option value="XII KI">XII KI</option>
                        </select>
                        <label for="jurusanSelect">Jurusan</label>
                    </div>
                    <!-- Keterangan -->
                    <div class="form-floating">
                        <textarea class="form-control" placeholder="Masukkan keterangan" id="keteranganTextarea" name="keterangan" style="height: 150px;"></textarea>
                        <label for="keteranganTextarea">Keterangan</label>
                    </div>
                    <!-- Tombol Submit -->
                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary w-100">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
 <!-- Form End -->
 <?php
// Konfigurasi koneksi ke database
$host = "localhost";
$user = "root"; // Sesuaikan dengan username database
$password = ""; // Sesuaikan dengan password database
$database = "db_sipraka"; // Nama database

// Membuat koneksi ke database
$conn = new mysqli($host, $user, $password, $database);

// Periksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}

// Periksa apakah form dikirim dengan metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $nama = trim($_POST['nama']);
    $tanggal = trim($_POST['tanggal']);
    $jurusan = trim($_POST['jurusan']);
    $keterangan = trim($_POST['keterangan']);

    // Validasi: Pastikan semua field telah diisi
    if (empty($nama) || empty($tanggal) || empty($jurusan)) {
        echo "<script>
                alert('Semua kolom wajib diisi!');
                window.location.href='absensisiswa.php';
              </script>";
        exit(); // Hentikan eksekusi jika ada field kosong
    }

    // Periksa apakah siswa sudah absen pada tanggal yang sama
    $cek_sql = "SELECT * FROM absensi WHERE nama = ? AND tanggal = ?";
    $stmt = $conn->prepare($cek_sql);
    $stmt->bind_param("ss", $nama, $tanggal);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Jika sudah absen, tampilkan peringatan
        echo "<script>
                alert('Anda sudah absen hari ini!');
                window.location.href='absensisiswa.php';
              </script>";
    } else {
        // Jika belum absen, simpan ke database
        $sql = "INSERT INTO absensi (nama, tanggal, jurusan, keterangan) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssss", $nama, $tanggal, $jurusan, $keterangan);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Absensi berhasil disimpan!');
                    window.location.href='absensisiswa.php';
                  </script>";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
}

// Tutup koneksi
$conn->close();
?>



            <!-- Footer Start -->
            <div class="container-fluid pt-4 px-4">
                <div class="bg-light rounded-top p-4">
                    <div class="row">
                        <div class="col-12 col-sm-6 text-center text-sm-start">
                            &copy; <a href="#">2025 SIPRAKA</a>, SMK Negeri 2 Bangkalan 
                        </div>
                    </div>
                </div>
            </div>
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