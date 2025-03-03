<?php
session_start();
require_once __DIR__ . '/config.php';

// Validasi ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    die("ID tidak valid");
}

$id = $_GET['id'];

// Query untuk mengambil data (disederhanakan)
$sql = "SELECT * FROM monitoring_pkl WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    die("Data tidak ditemukan");
}

$data = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Surat Monitoring PKL</title>
    <!-- Bootstrap CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <div class="row">
            <div class="col-2">
                <img src="img/jatim.png" alt="Logo" style="width: 100px;">
            </div>
            <div class="col-10 text-center">
                <h5>PEMERINTAH PROVINSI JAWA TIMUR</h5>
                <h6>DINAS PENDIDIKAN</h6>
                <h6>SMK NEGERI 2 BANGKALAN</h6>
                <h6>NPSN/NSS: 20531223 / 321052901002</h6>
                <p>Jalan. Halim Perdana Kusuma, Bangkalan, Jawa Timur 69116</p>
                <p>Telepon (031) 3092223, Email: smkn2_bkl@yahoo.com</p>
            </div>
        </div>
        <hr>
        
        <h5 class="text-center"><u>SURAT TUGAS</u></h5>
        <p class="text-end">Bangkalan, <?= date("d F Y", strtotime($data['tanggal_surat'])) ?></p>
        <p class="text-center">Nomor: <?= htmlspecialchars($data['nomor_surat']) ?></p>
        
        <p>Yang bertanda tangan di bawah ini, Kepala SMK Negeri 2 Bangkalan dengan ini:</p>
        <h6 class="text-center"><strong>MENUGASKAN</strong></h6>
        
        <p><strong>Kepada:</strong></p>
        <p>Nama: <?= htmlspecialchars($data['nama_guru']) ?></p>
        <p>NIP: <?= htmlspecialchars($data['nip_guru']) ?></p>
        <p>Jabatan: <?= htmlspecialchars($data['jabatan_guru']) ?></p>
        
        <p>Untuk: Monitoring siswa PKL ke <strong><?= htmlspecialchars($data['tempat_pkl']) ?></strong></p>
        <p>Alamat: <?= nl2br(htmlspecialchars($data['alamat_pkl'])) ?></p>
        <p>Pada tanggal: <?= date("d F Y", strtotime($data['tanggal_mulai'])) ?> s/d <?= date("d F Y", strtotime($data['tanggal_berakhir'])) ?></p>
        <p>Konsentrasi Keahlian: <strong><?= htmlspecialchars($data['konsentrasi_keahlian']) ?></strong></p>

        <!-- Tabel Siswa -->
        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Siswa</th>
                    <th>Catatan Monitoring</th>
                    <th>Tanda Tangan Siswa</th>
                    <th>Tanda Tangan Pembimbing DU/DI</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $siswa_list = explode("\n", $data['siswa']);
                foreach ($siswa_list as $index => $siswa) {
                    if (!empty(trim($siswa))) {
                        echo "<tr>";
                        echo "<td>" . ($index + 1) . "</td>";
                        echo "<td>" . htmlspecialchars($siswa) . "</td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "<td></td>";
                        echo "</tr>";
                    }
                }
                ?>
            </tbody>
        </table>

        <!-- Tanda Tangan -->
        <div class="row mt-5">
            <div class="col-6">
                <p>Telah diketahui oleh:</p>
                <p><strong>Pihak DU/DI</strong></p>
                <br><br><br>
                <p>.................................</p>
                <p>(Nama Terang + Tanda tangan + Stempel)</p>
            </div>
            <div class="col-6 text-end">
                <p>Bangkalan, <?= date("d F Y", strtotime($data['tanggal_surat'])) ?></p>
                <p>Kepala SMK Negeri 2 Bangkalan</p>
                <br><br><br>
                <p><strong>Nur Hazizah, S.Pd., M.Pd.</strong></p>
                <p>NIP. 19700417 199702 2 002</p>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="js/bootstrap.bundle.min.js"></script>
</body>
</html>

