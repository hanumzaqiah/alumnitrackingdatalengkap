<?php
include "../koneksi.php";

$alumni = $_POST['alumni'];
$pekerjaan = $_POST['pekerjaan'];
$perusahaan = $_POST['perusahaan'];
$lokasi = $_POST['lokasi'];
$sumber = $_POST['sumber'];

mysqli_query($conn,"INSERT INTO hasil_pelacakan VALUES('','$alumni','$pekerjaan','$perusahaan','$lokasi','$sumber')");

header("Location: ../hasil/hasil_pelacakan.php");
?>