<?php
require 'proses.php';

if (!isset($_GET['id'])) {
    echo "ID surat tidak ditemukan!";
    exit();
}

$id = $_GET['id'];
$sql = "SELECT * FROM penarikan_pkl WHERE id = $id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "Data surat tidak ditemukan!";
    exit();
}

$data = mysqli_fetch_assoc($result);
$siswa_list = explode("\n", $data['siswa_list']);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Penarikan PKL</title>
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
            <p class="text-end">Bangkalan, <?= date("d F Y", strtotime($data['tanggal_surat'])); ?></p>
            <p>Nomor: <?= $data['nomor_surat']; ?></p>
            <P>Lampiran: - </P>
            <p>Hal: Penarikan siswa Praktik Kerja Lapangan</p>
            <p>Kepada Yth: <strong>Bapak/Ibu Pimpinan</strong></p>
            <p><strong><?= $data['tempat_pkl']; ?></strong></p>
            <p><?= $data['alamat_pkl']; ?></p>
            <p>Assalamu'alaikum Wr. Wb.</p>
            <p>Dengan hormat,</p>
            <p>Dengan ini Tim Praktek Kerja Lapangan (PKL) SMK Negeri 2 Bangkalan, menginformasikan siswa:</p>
            <p><strong>Konsentrasi Keahlian: </strong><?= $data['konsentrasi_keahlian']; ?></p>
            <table class="table table-bordered text-center">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Siswa</th>
                        <th>NISN</th>
                        <th>Tingkat / Semester</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($siswa_list as $index => $siswa) {
                        $siswa_data = explode(",", $siswa);
                        echo "<tr>
                                <td>" . ($index + 1) . "</td>
                                <td>{$siswa_data[0]}</td>
                                <td>{$siswa_data[1]}</td>
                                <td>{$siswa_data[2]}</td>
                              </tr>";
                    }
                    ?>
                </tbody>
            </table>
            <p>Peserta Praktek Kerja Lapangan pada Perusahaan Bapak/Ibu akan kami tarik, karena masa pelaksanaan PKL berakhir tanggal <?= date("d F Y", strtotime($data['tanggal_berakhir'])); ?>.</p>
            <p>Terima kasih atas kerjasamanya dalam membimbing serta membina siswa kami selama ini.</p>
            <p>Besar harapan kami untuk dapat melanjutkan kerja sama ini dimasa mendatang.</p>
            <P>Wassalamu'alaikum Wr. Wb</P>
            <div class="text-end">
                <p>Hormat Kami,</p>
                <p>Kepala SMK Negeri 2 Bangkalan</p>
                <br><br><br>
                <p><strong>Nur Hazizah, S.Pd., M.Pd.</strong></p>
            </div>
        </div>
    </div>
</body>
</html>
