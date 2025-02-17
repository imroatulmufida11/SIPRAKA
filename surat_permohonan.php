<?php
include 'config.php';

if (!isset($_GET["id"])) {
    echo "Data tidak ditemukan!";
    exit;
}

$id = $_GET["id"];
$sql = "SELECT * FROM permohonan_pkl WHERE id = $id";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Permohonan PKL</title>
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
        <p class="text-end">Bangkalan, <?= date("d F Y") ?></p>
        <p>Nomor: <?= $row["nomor_surat"] ?></p>
        <p>Hal: Permohonan Praktik Kerja Lapangan</p>
        <p>Lampiran: - </p>
        <p>Kepada Yth: <strong>Pimpinan/Direktur <?= nl2br($row["tempat_pkl"]) ?></strong></p>
        <p><?= nl2br($row["alamat_pkl"]) ?></p>
        <p>Assalamu'alaikum Wr. Wb.</p>
        <p>Dengan hormat,</p>
        <p>Dalam penyelenggaraan Pendidikan tingkat kejuruan, disamping siswa melaksanakan Kegiatan Belajar Mengajar (KBM) di sekolah, siswa juga dituntut melaksanakan KBM di Dunia Usaha / Dunia Industri, yang dikenal istilah PKL (Praktik Kerja Lapangan).</p>
        <p>Berdasarkan kurikulum merdeka dilaksanakan selama 6 bulan, untuk itu kami mohon dengan sangat agar Bapak / Ibu Pimpinan <strong><span><?= $row["tempat_pkl"] ?></span></strong>.</p>
        <p><strong>Konsentrasi Keahlian:</strong> <?= $row["konsentrasi_keahlian"] ?></p>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>NISN</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $siswaList = explode("\n", $row["siswa"]);
                foreach ($siswaList as $index => $siswa) {  
                    $data = explode(" - ", trim($siswa));
                    if (count($data) == 2) {
                        echo "<tr><td>" . ($index + 1) . "</td><td>$data[0]</td><td>$data[1]</td></tr>";
                    }
                }
                ?>
            </tbody>
        </table>
        <div class="text-start">
            
            <p>Jika berkenan kami berharap PKL ini dapat dilaksanakan mulai tanggal <?= $row["tanggal_mulai"] ?> sampai dengan tanggal <?= $row["tanggal_berakhir"] ?></p>
            <p>Kami berharap jawaban/informasi tentang waktu dan lama pelaksanaan PKL pada DU/DI Bapak/ibu segera kami dapatkan</p>
            <P>Atas perhatian dan berkenannya permohonan ini, kami sampaikan terima kasih </P>
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
<?php
} else {
    echo "Data tidak ditemukan!";
}
?>
