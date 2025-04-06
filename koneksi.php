<?php
include 'config.php';

// Ambil data Du/Di dari database untuk dropdown
$sql = "SELECT id, nama_dudi, alamat FROM data_dudi";
$result = $conn->query($sql);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan semua input diambil dengan isset()
    $nomor_surat = isset($_POST['nomor_surat']) ? mysqli_real_escape_string($conn, $_POST['nomor_surat']) : '';
    $dudi_id = isset($_POST['dudi_id']) ? mysqli_real_escape_string($conn, $_POST['dudi_id']) : 0;
    $tempat_pkl = isset($_POST['tempat_pkl']) ? mysqli_real_escape_string($conn, $_POST['tempat_pkl']) : '';
    $alamat_pkl = isset($_POST['alamat_pkl']) ? mysqli_real_escape_string($conn, $_POST['alamat_pkl']) : '';
    $kota_pkl = isset($_POST['kota_pkl']) ? mysqli_real_escape_string($conn, $_POST['kota_pkl']) : '';
    $tanggal_mulai = isset($_POST['tanggal_mulai']) ? mysqli_real_escape_string($conn, $_POST['tanggal_mulai']) : '';
    $tanggal_berakhir = isset($_POST['tanggal_berakhir']) ? mysqli_real_escape_string($conn, $_POST['tanggal_berakhir']) : '';
    $konsentrasi_keahlian = isset($_POST['konsentrasi_keahlian']) ? mysqli_real_escape_string($conn, $_POST['konsentrasi_keahlian']) : '';
    $siswa = isset($_POST['siswa']) ? mysqli_real_escape_string($conn, trim($_POST['siswa'])) : '';

    // Cek apakah dudi_id ada di tabel data_dudi
    $cek_dudi = mysqli_query($conn, "SELECT id FROM data_dudi WHERE id = '$dudi_id'");
    if (mysqli_num_rows($cek_dudi) == 0) {
        die("Error: Du/Di tidak ditemukan dalam database.");
    }

    // Query untuk menyimpan data ke tabel surat_pengantar
    $sql = "INSERT INTO surat_pengantar (nomor_surat, dudi_id, tempat_pkl, alamat_pkl, kota_pkl, tanggal_mulai, tanggal_berakhir, konsentrasi_keahlian, siswa) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = mysqli_prepare($conn, $sql);
    
    // Cek apakah prepare berhasil
    if (!$stmt) {
        die("Prepare failed: " . mysqli_error($conn));
    }

    mysqli_stmt_bind_param($stmt, "sisssssss", $nomor_surat, $dudi_id, $tempat_pkl, $alamat_pkl, $kota_pkl, $tanggal_mulai, $tanggal_berakhir, $konsentrasi_keahlian, $siswa);

    if (mysqli_stmt_execute($stmt)) {
        $last_id = mysqli_insert_id($conn);
        mysqli_stmt_close($stmt);
        header("Location: surat_pengantar.php?id=" . $last_id);
        exit();
    } else {
        echo "Execute failed: " . mysqli_error($conn);
    }
}
?>
