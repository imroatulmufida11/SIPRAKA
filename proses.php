<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Menangkap data dari form
    $nomor_surat = $_POST["nomorSurat"];
    $tempat_pkl = $_POST["tempatPkl"];
    $alamat_pkl = $_POST["alamatPkl"];
    $dudi_id = $_POST["dudiId"];
    $konsentrasi_keahlian = $_POST["konsentrasiKeahlian"];
    $siswa_id = $_POST["siswa_id"]; // Pastikan nama sesuai dengan form
    $tanggal_mulai = $_POST["tanggalMulai"];
    $tanggal_berakhir = $_POST["tanggalBerakhir"];

    // Prepared statement untuk menghindari SQL Injection
    $sql = "INSERT INTO permohonan_pkl (nomor_surat, dudi_id, tempat_pkl, alamat_pkl, konsentrasi_keahlian, siswa_id, tanggal_mulai, tanggal_berakhir) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    if ($stmt = $conn->prepare($sql)) {
        // Bind parameter
        $stmt->bind_param("ssssssss", $nomor_surat, $dudi_id, $tempat_pkl, $alamat_pkl, $konsentrasi_keahlian, $siswa_id, $tanggal_mulai, $tanggal_berakhir);

        // Eksekusi statement
        if ($stmt->execute()) {
            // Ambil ID dari record yang baru dimasukkan
            $id = $stmt->insert_id;
            // Redirect ke halaman surat_permohonan.php dengan ID surat
            header("Location: surat_permohonan.php?id=" . $id);
            exit();
        } else {
            // Jika gagal eksekusi query
            echo "Error: " . $stmt->error;
        }

        // Tutup statement
        $stmt->close();
    } else {
        // Jika gagal mempersiapkan statement
        echo "Error: " . $conn->error;
    }
}

// Tutup koneksi setelah selesai
$conn->close();
?>
