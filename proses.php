<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomor_surat = $_POST["nomorSurat"];
    $tempat_pkl = $_POST["tempatPkl"];
    $alamat_pkl = $_POST["alamatPkl"];
    $dudi_id = $_POST["dudiId"];
    $konsentrasi_keahlian = $_POST["konsentrasiKeahlian"];
    $siswa = $_POST["siswaList"];
    $tanggal_mulai = $_POST["tanggalMulai"];
    $tanggal_berakhir = $_POST["tanggalBerakhir"];

    // echo "Data" . $nomor_surat, $tempat_pkl, $alamat_pkl, $konsentrasi_keahlian, $siswa, $tanggal_mulai, $tanggal_berakhir;
    $sql = "INSERT INTO permohonan_pkl (nomor_surat, dudi_id, tempat_pkl, alamat_pkl, konsentrasi_keahlian, siswa, tanggal_mulai, tanggal_berakhir) 
            VALUES ('$nomor_surat', '$dudi_id','$tempat_pkl','$alamat_pkl', '$konsentrasi_keahlian', '$siswa', '$tanggal_mulai', '$tanggal_berakhir')";

    if (mysqli_query($conn, $sql)) {
        $id = mysqli_insert_id($conn);
        header("Location: surat_permohonan.php?id=" . $id);
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
