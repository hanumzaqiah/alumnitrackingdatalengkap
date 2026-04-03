<?php
include "../koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM alumni");
?>

<!DOCTYPE html>
<html>

<head>
<title>Data Alumni</title>

<style>
body {
    font-family: 'Segoe UI', sans-serif;
    background: #eef3f8;
    margin:0;
}

/* HEADER */
.header {
    background: linear-gradient(90deg, #1ba0e2, #007bff);
    color:white;
    padding:22px;
    text-align:center;
    font-size:26px;
    font-weight:600;
}

/* CONTAINER */
.container {
    padding:20px;
}

/* CARD */
.card {
    background:white;
    padding:25px;
    border-radius:18px;
    box-shadow:0 6px 20px rgba(0,0,0,0.08);
}

/* TITLE */
.title {
    font-size:20px;
    font-weight:600;
    margin-bottom:10px;
}

/* BUTTON */
.button {
    background:#1ba0e2;
    color:white;
    padding:8px 14px;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    transition:0.3s;
    display:inline-block;
    margin-right:5px;
}

.button:hover {
    background:#0d8ad1;
}

/* TABLE */
table {
    width:100%;
    border-collapse:collapse;
    font-size:13px;
}

/* HEADER TABLE */
th {
    background:#1ba0e2;
    color:white;
    padding:12px;
}

/* DATA */
td {
    padding:10px;
    border-bottom:1px solid #eee;
    text-align:center;
}

/* HOVER */
tr:hover {
    background:#f4faff;
}

/* 🔥 KHUSUS NAMA */
td.nama {
    white-space: normal;
    word-break: break-word;
    max-width: 150px;
}

/* kolom lain tetap rapi */
td:not(.nama) {
    white-space: nowrap;
}

/* AKSI */
td.aksi {
    min-width:120px;
}

/* SCROLL */
.table-container {
    overflow-x:auto;
}
</style>

</head>

<body>

<div class="header">
Data Alumni
</div>

<div class="container">
<div class="card">

<div class="title">Daftar Alumni</div>

<a class="button" href="../dashboard.php">← Kembali ke Dashboard</a>
<a class="button" href="tambah_alumni.php">+ Tambah Alumni</a>

<br><br>

<div class="table-container">
<table>

<tr>
<th>No</th>
<th>Nama</th>
<th>NIM</th>
<th>Tahun Masuk</th>
<th>Tanggal Lulus</th>
<th>Fakultas</th>
<th>Program Studi</th>
<th>Status</th>
<th>Persentase</th>
<th>Aksi</th>
</tr>

<?php 
$no = 1;
while($d = mysqli_fetch_assoc($data)){ 
?>

<tr>
<td><?= $no++; ?></td>

<td class="nama"><?= $d['nama']; ?></td>

<td><?= $d['nim']; ?></td>
<td><?= $d['tahun_masuk']; ?></td>
<td><?= $d['tanggal_lulus']; ?></td>
<td><?= $d['fakultas']; ?></td>
<td><?= $d['program_studi']; ?></td>
<td><?= $d['status']; ?></td>
<td><?= $d['persentase']; ?>%</td>

<td class="aksi">
<a class="button" href="edit_alumni.php?id=<?= $d['id']; ?>">Edit</a>
<a class="button" 
href="hapus_alumni.php?id=<?= $d['id']; ?>"
onclick="return confirm('Yakin ingin menghapus data ini?')">
Hapus
</a>
</td>
</tr>

<?php } ?>

</table>
</div>

</div>
</div>

</body>
</html>