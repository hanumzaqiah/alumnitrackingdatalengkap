<?php
include "../koneksi.php";

$id = $_GET['id'];

mysqli_query($conn,"DELETE FROM alumni WHERE id='$id'");

header("location:alumni.php");
?>