<?php
require 'proses.php';

if (!isset($_GET['id'])) {
    echo "ID surat tidak ditemukan!";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM monitoring_pkl WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Data surat tidak ditemukan!";
    exit();
}

$data = mysqli_fetch_assoc($result);
$siswa_list = explode("\n", $data['siswa']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Tugas PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
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
    <p class="text-end">Bangkalan, <?= date("d F Y", strtotime($data['tanggal_surat'])); ?></p>
    <p class="text-center">Nomor: <?= $data['nomor_surat']; ?></p>
    <p>Yang bertanda tangan di bawah ini, Kepala SMK Negeri 2 Bangkalan dengan ini:</p>
    <h6 class="text-center"><strong>MENUGASKAN</strong></h6>
    <p><strong>Kepada:</strong></p>
    <p>Nama: <?= $data['nama_guru']; ?></p>
    <p>NIP: <?= $data['nip_guru']; ?></p>
    <p>Jabatan: <?= $data['jabatan_guru']; ?></p>
    <p>Untuk: Monitoring siswa PKL ke <strong><?= $data['tempat_pkl']; ?></strong><br><?= nl2br($data["alamat_pkl"]); ?></p>
    <p>Pada tanggal </p>
    <p>Konsentrasi Keahlian: <strong><?= $data['konsentrasi_keahlian']; ?></strong></p>
    <table class="table table-bordered text-center">
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
            <?php foreach ($siswa_list as $index => $siswa) { ?>
                <tr>
                    <td><?= $index + 1; ?></td>
                    <td><?= $siswa; ?></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>
    <div class="row mt-4">
   <div class="col text-start">
   <p>Telah diketahui oleh:</p>
   <p><strong>Pihak DU/DI</strong></p>
   <br><br><br>
   <p>...............................................</p>
   <p>(Nama Terang + Tanda tangan + Stempel)</p>
    </div>
    <div class="col text-end">
     <p>Dikeluarkan di: Bangkalan</p>
     <p>Pada tanggal: <?= date("d F Y", strtotime($data['tanggal_surat'])); ?></p>
     <p>Kepala SMK Negeri 2 Bangkalan</p>
     <br><br><br>
     <p><strong>Nur Hazizah, S.Pd., M.Pd.</strong></p>
     </div>
     </div>
</body>
</html>


