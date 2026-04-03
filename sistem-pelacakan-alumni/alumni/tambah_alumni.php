<?php
session_start();
$data_excel = $_SESSION['excel'] ?? null;
?>

<!DOCTYPE html>
<html>

<head>
<title>Tambah Alumni</title>
<link rel="stylesheet" href="../assets/css/style.css">
</head>

<body>

<div class="header">
Sistem Pelacakan Alumni
</div>

<div class="container">
<div class="card">

<div class="title">Tambah Data Alumni</div>

<form method="POST" action="simpan_alumni.php">

<div class="form-group">
<label>Nama</label>
<input type="text" name="nama" required 
value="<?= $data_excel['nama'] ?? '' ?>">
</div>

<div class="form-group">
<label>NIM</label>
<input type="text" name="nim" required 
value="<?= $data_excel['nim'] ?? '' ?>">
</div>

<div class="form-group">
<label>Tahun Masuk</label>
<input type="number" name="tahun_masuk" required 
value="<?= $data_excel['tahun_masuk'] ?? '' ?>">
</div>

<div class="form-group">
<label>Tanggal Lulus</label>
<input type="date" name="tanggal_lulus" required 
value="<?= isset($data_excel['tanggal_lulus']) 
? date('Y-m-d', strtotime($data_excel['tanggal_lulus'])) 
: '' ?>">
</div>

<div class="form-group">
<label>Fakultas</label>
<input type="text" name="fakultas" required 
value="<?= $data_excel['fakultas'] ?? '' ?>">
</div>

<div class="form-group">
<label>Program Studi</label>
<input type="text" name="jurusan" required 
value="<?= $data_excel['jurusan'] ?? '' ?>">
</div>

<button class="button">Simpan</button>

</form>

<br>

<a class="button" href="alumni.php">Kembali</a>

</div>
</div>

</body>
</html>