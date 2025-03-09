<?php
include 'config.php';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi input
    $nomor_surat = mysqli_real_escape_string($conn, $_POST['nomorSurat']);
    $tempat_pkl = mysqli_real_escape_string($conn, $_POST['tempatPkl']);
    $alamat_pkl = mysqli_real_escape_string($conn, $_POST['alamatPkl']);
    $tanggal_berakhir = mysqli_real_escape_string($conn, $_POST['tanggalBerakhir']);
    $konsentrasi_keahlian = mysqli_real_escape_string($conn, $_POST['konsentrasiKeahlian']);
    
    // Proses data siswa
    $nama_siswa = isset($_POST['nama']) ? $_POST['nama'] : [];
    $nisn = isset($_POST['nisn']) ? $_POST['nisn'] : [];
    $tingkat = isset($_POST['tingkat']) ? $_POST['tingkat'] : [];
    
    // Gabungkan data siswa dalam format yang diinginkan
    $siswa_list = [];
    for ($i = 0; $i < count($nama_siswa); $i++) {
        if (!empty($nama_siswa[$i]) && !empty($nisn[$i]) && !empty($tingkat[$i])) {
            $siswa_list[] = trim($nama_siswa[$i]) . ", " . trim($nisn[$i]) . ", " . trim($tingkat[$i]);
        }
    }
    $siswa_list_string = implode("\n", $siswa_list);

    // Query untuk menyimpan data
    $sql = "INSERT INTO penarikan_pkl (nomor_surat, tempat_pkl, alamat_pkl, tanggal_berakhir, konsentrasi_keahlian, siswa_list) 
            VALUES (?, ?, ?, ?, ?, ?)";
            
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "ssssss", $nomor_surat, $tempat_pkl, $alamat_pkl, $tanggal_berakhir, $konsentrasi_keahlian, $siswa_list_string);

    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        header("Location: surat_penarikan.php?id=" . $last_id);
        exit();
    } else {
        $error_message = "Error: " . mysqli_error($conn);
    }
}
?>

<?php
@include('header.php');
?>
    
    <div class="container-fluid pt-4 px-4">
    <div class="row g-4">
        <div class="col-12">
            <div class="bg-light rounded h-100 p-4">
                <h2 class="text-center">Formulir Surat Penarikan PKL</h2>

                <?php if (isset($error_message)): ?>
                    <div class="alert alert-danger"><?php echo $error_message; ?></div>
                <?php endif; ?>

                <form method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nomor Surat:</label>
                        <input type="text" class="form-control" name="nomorSurat" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tempat PKL:</label>
                        <input type="text" class="form-control" name="tempatPkl" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Alamat PKL:</label>
                        <textarea class="form-control" name="alamatPkl" rows="2" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Tanggal Berakhir PKL:</label>
                        <input type="date" class="form-control" name="tanggalBerakhir" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Konsentrasi Keahlian:</label>
                        <input type="text" class="form-control" name="konsentrasiKeahlian" required>
                    </div>

                    <div id="siswa-container">
                        <h4>Data Siswa</h4>
                        <div class="siswa-form" style="border: 1px solid #ddd; padding: 15px; margin-bottom: 10px; border-radius: 5px;">
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">Nama Siswa:</label>
                                    <input type="text" class="form-control" name="nama[]" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label class="form-label">NISN:</label>
                                    <input type="text" class="form-control" name="nisn[]" required>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label class="form-label">Tingkat/Semester:</label>
                                    <input type="text" class="form-control" name="tingkat[]" placeholder="Contoh: XII/1" required>
                                </div>
                                <div class="col-md-1 mb-3 d-flex align-items-end">
                                    <button type="button" class="btn btn-danger remove-siswa" style="color: red; cursor: pointer;" onclick="removeSiswa(this)">×</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <button type="button" class="btn btn-success" onclick="addSiswa()">Tambah Siswa</button>
                    <button type="submit" class="btn btn-primary">Buat Surat</button>
                </form>
            </div>
        </div>
    </div>
</div>


   <!-- Footer Start -->
<div class="container-fluid pt-4 px-4">
    <div class="bg-light rounded-top p-4 text-center">
        <div class="row justify-content-center">
            <div class="col-12">
                &copy; <a href="#">2025 SIPRAKA</a>, All Rights Reserved.
            </div>
        </div>
    </div>
</div>
<!-- Footer End -->

           
<div>
        <!-- Back to Top -->
        <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>
    </div>
    
    <script>
        function addSiswa() {
            const container = document.getElementById('siswa-container');
            const template = document.querySelector('.siswa-form').cloneNode(true);
            
            // Reset input values
            template.querySelectorAll('input').forEach(input => input.value = '');
            
            container.appendChild(template);
        }

        function removeSiswa(button) {
            const forms = document.querySelectorAll('.siswa-form');
            if (forms.length > 1) {
                button.closest('.siswa-form').remove();
            } else {
                alert('Minimal harus ada satu siswa!');
            }
        }
    </script>

    

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
