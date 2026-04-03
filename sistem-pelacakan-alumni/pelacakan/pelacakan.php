<?php
include "../koneksi.php";

$data = mysqli_query($conn,"SELECT * FROM alumni");
?>

<!DOCTYPE html>
<html>

<head>
<title>Pelacakan Alumni</title>

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

/* BUTTON */
.button {
    background:#1ba0e2;
    color:white;
    padding:8px 14px;
    border-radius:10px;
    text-decoration:none;
    font-size:13px;
    transition:0.3s;
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

/* 🔥 nama bisa turun */
td.nama {
    white-space: normal;
    word-break: break-word;
    max-width: 150px;
}

/* kolom lain tetap rapi */
td:not(.nama) {
    white-space: nowrap;
}

/* SCROLL */
.table-container {
    overflow-x:auto;
}

/* AKSI */
td.aksi {
    min-width:120px;
}
</style>

</head>

<body>

<div class="header">
Mulai Pelacakan Alumni
</div>

<div class="container">
<div class="card">

<a class="button" href="../dashboard.php">
← Kembali ke Dashboard
</a>

<br><br>

<div class="table-container">
<table>

<tr>
<th>No</th>
<th>Nama</th>
<th>Status</th>
<th>Persentase</th>
<th>Pencarian Akademik</th>
<th>Pencarian Profesional</th>
<th>Verifikasi Web</th>
<th>Aksi</th>
</tr>

<?php 
$no = 1;
while($d = mysqli_fetch_assoc($data)){ 

$keyword = urlencode($d['nama']." ".$d['fakultas']." ".$d['program_studi']);
?>

<tr>

<td><?= $no++; ?></td>

<td class="nama"><?= $d['nama']; ?></td>

<td><?= $d['status']; ?></td>

<td><?= $d['persentase']; ?>%</td>

<td>
<a class="button"
href="https://scholar.google.com/scholar?q=<?= $keyword; ?>"
target="_blank">
Scholar
</a>

<a class="button"
href="https://orcid.org/orcid-search/search?searchQuery=<?= $keyword; ?>"
target="_blank">
ORCID
</a>
</td>

<td>
<a class="button"
href="https://www.linkedin.com/search/results/all/?keywords=<?= $keyword; ?>"
target="_blank">
LinkedIn
</a>
</td>

<td>
<a class="button"
href="https://www.google.com/search?q=<?= $keyword; ?>"
target="_blank">
Google
</a>
</td>

<td class="aksi">
<a class="button"
href="proses_lacak.php?id=<?= $d['id']; ?>">
Lacak
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