<?php
require 'proses.php'; // Koneksi ke database

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_surat = $_POST['nomorSurat'];
    $nama_guru = $_POST['namaGuru'];
    $nip_guru = $_POST['nipGuru'];
    $jabatan_guru = $_POST['jabatanGuru'];
    $tempat_pkl = $_POST['tempatPkl'];
    $alamat_pkl = $_POST['alamatPkl'];
    $tanggal_surat = $_POST['tanggalSurat'];
    $konsentrasi_keahlian = $_POST['konsentrasiKeahlian'];
    $siswa = implode("\n", $_POST['siswaList']); // Mengubah array menjadi string

    $sql = "INSERT INTO monitoring_pkl (nomor_surat, nama_guru, nip_guru, jabatan_guru, tempat_pkl,alamat_pkl, tanggal_surat, konsentrasi_keahlian, siswa) 
            VALUES ('$nomor_surat', '$nama_guru', '$nip_guru', '$jabatan_guru', '$tempat_pkl','$alamat_pkl', '$tanggal_surat', '$konsentrasi_keahlian', '$siswa')";

    if (mysqli_query($conn, $sql)) {
        header("Location: surat_monitoring.php?id=" . mysqli_insert_id($conn));
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
    <title>Formulir Surat Tugas PKL</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-4">
        <h2 class="text-center">Formulir Surat Tugas PKL</h2>
        <form method="POST">
            <div class="mb-3">
                <label class="form-label">Nomor Surat:</label>
                <input type="text" class="form-control" name="nomorSurat" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Guru Pembimbing:</label>
                <input type="text" class="form-control" name="namaGuru" required>
            </div>
            <div class="mb-3">
                <label class="form-label">NIP:</label>
                <input type="text" class="form-control" name="nipGuru" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Jabatan:</label>
                <input type="text" class="form-control" name="jabatanGuru" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Tempat PKL:</label>
                <textarea class="form-control" name="tempatPkl" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Alamat PKL:</label>
                <textarea class="form-control" name="alamatPkl" rows="2" required></textarea>
            </div>
            <div class="mb-3">
                <label class="form-label">Tanggal Surat:</label>
                <input type="date" class="form-control" name="tanggalSurat" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Konsentrasi Keahlian:</label>
                <input type="text" class="form-control" name="konsentrasiKeahlian" required>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Siswa (Setiap Nama di Baris Baru):</label>
                <textarea class="form-control" name="siswaList[]" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Buat Surat</button>
        </form>
    </div>
</body>
</html>
