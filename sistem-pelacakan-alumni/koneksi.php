<?php
$host = "sql100.infinityfree.com";
$user = "if0_41571636";
$password = "Hanumpermata28";
$db = "if0_41571636_db_alumni"; // WAJIB pakai prefix hosting

$conn = mysqli_connect($host, $user, $password, $db);

// cek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>