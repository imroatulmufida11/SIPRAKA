<?php
require 'proses.php'; // File koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_surat = $_POST['nomorSurat'];
    $tempat_pkl = $_POST['tempatPkl'];
    $alamat_pkl = $_POST['alamatPkl'];
    $tanggal_berakhir = $_POST['tanggalBerakhir'];
    $konsentrasi_keahlian = $_POST['konsentrasiKeahlian'];
    $siswa_list = implode("\n", $_POST['siswaList']); // Mengubah array menjadi string

    $sql = "INSERT INTO penarikan_pkl (nomor_surat, tempat_pkl, alamat_pkl, tanggal_berakhir, konsentrasi_keahlian, siswa_list) 
            VALUES ('$nomor_surat', '$tempat_pkl', '$alamat_pkl', '$tanggal_berakhir', '$konsentrasi_keahlian', '$siswa_list')";

    if (mysqli_query($conn, $sql)) {
        header("Location: surat_penarikan.php?id=" . mysqli_insert_id($conn));
        exit();
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Surat Penarikan PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Formulir Surat Penarikan PKL</h2>
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
            <div class="mb-3">
                <label class="form-label">Nama, NISN, dan Tingkat Siswa:</label>
                <textarea class="form-control" name="siswaList[]" rows="3" placeholder="Contoh: Achmad Daniel Reza, 0079462072, XII/1" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Buat Surat</button>
        </form>
    </div>
</body>
</html>
