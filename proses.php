<?php
require 'config.php'; // Pastikan file koneksi database tersedia

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan koneksi tersedia
    if (!isset($conn)) {
        die("Koneksi database tidak tersedia.");
    }

    // Tangkap data dari form
    $nomor_surat = $_POST['nomorSurat'];
    $tempat_pkl = $_POST['tempatPkl']; // Nama DU/DI
    $alamat_pkl = $_POST['alamatPkl'];
    $konsentrasi_keahlian = $_POST['konsentrasiKeahlian'];
    $tanggal_mulai = $_POST['tanggalMulai'];
    $tanggal_berakhir = $_POST['tanggalBerakhir'];

    // Pastikan siswaList disimpan dengan format yang benar
    $siswa = isset($_POST['siswaList']) ? implode("\n", (array)$_POST['siswaList']) : '';

    // Cari ID DU/DI berdasarkan nama tempat PKL
    $query = "SELECT id FROM data_dudi WHERE nama_dudi = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $tempat_pkl);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row) {
        die("Error: DU/DI tidak ditemukan!");
    }

    $dudi_id = $row['id']; // ID DU/DI yang valid

    // Simpan data ke database
    $sql = "INSERT INTO permohonan_pkl (dudi_id, nomor_surat, tempat_pkl, alamat_pkl, konsentrasi_keahlian, siswa, tanggal_mulai, tanggal_berakhir) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isssssss", $dudi_id, $nomor_surat, $tempat_pkl, $alamat_pkl, $konsentrasi_keahlian, $siswa, $tanggal_mulai, $tanggal_berakhir);
        
        if ($stmt->execute()) {
            header("Location: surat_permohonan.php?id=" . $stmt->insert_id);
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Error dalam persiapan query: " . $conn->error;
    }
}

// Ambil daftar DU/DI dari database
$sql = "SELECT id, nama_dudi, alamat FROM data_dudi LIMIT 100";
$result = $conn->query($sql);

if (!$result) {
    die("Error dalam mengambil data: " . $conn->error);
}

// Bebaskan hasil setelah digunakan untuk menghemat memori
$result->free();
?>
