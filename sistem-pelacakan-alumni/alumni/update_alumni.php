<?php
include "../koneksi.php";

$id = $_POST['id'];
$nama = $_POST['nama'];
$universitas = $_POST['universitas'];
$jurusan = $_POST['jurusan'];
$tahun = $_POST['tahun'];

mysqli_query($conn,"
UPDATE alumni SET
nama='$nama',
universitas='$universitas',
jurusan='$jurusan',
tahun_lulus='$tahun'
WHERE id='$id'
");

header("location:alumni.php");
?>