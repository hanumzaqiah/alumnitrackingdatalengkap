<?php

include "../koneksi.php";

$nama = $_POST['nama'];
$nim = $_POST['nim'];
$tahun_masuk = $_POST['tahun_masuk'];
$tanggal_lulus = $_POST['tanggal_lulus'];
$fakultas = $_POST['fakultas'];
$jurusan = $_POST['jurusan'];

mysqli_query($conn,"
INSERT INTO alumni
(nama,nim,tahun_masuk,tanggal_lulus,fakultas,jurusan,status,persentase)
VALUES
('$nama','$nim','$tahun_masuk','$tanggal_lulus','$fakultas','$jurusan','Belum Dilacak','0')
");

header("location:alumni.php");

?>