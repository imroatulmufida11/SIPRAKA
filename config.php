<?php
$host = "localhost";
$user = "root";  // Ganti sesuai database kamu
$pass = "";      // Ganti jika ada password
$db   = "db_sipraka";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>
