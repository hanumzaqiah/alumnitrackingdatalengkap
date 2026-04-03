<?php
include "koneksi.php";

$currentPage = basename($_SERVER['PHP_SELF']);

/* HITUNG DATA */
$terdeteksi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM alumni WHERE status='Terdeteksi'"))['t'];
$verifikasi = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM alumni WHERE status='Perlu Verifikasi'"))['t'];
$tidak = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) as t FROM alumni WHERE status='Tidak Ditemukan'"))['t'];

$total = $terdeteksi + $verifikasi + $tidak;
if($total == 0) $total = 1;
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Dashboard</title>

<style>
*{margin:0;padding:0;box-sizing:border-box;}

body{
font-family:"Segoe UI", Arial;
background:#f5f7fb;
}

.wrapper{display:flex;}

.sidebar{
width:220px;
background:#1BA0E2;
color:white;
padding:20px;
height:100vh;
position:fixed;
}

.sidebar h2{margin-bottom:25px;}

.sidebar a{
display:block;
color:white;
padding:12px;
margin-bottom:10px;
border-radius:8px;
text-decoration:none;
transition:0.2s;
}

.sidebar a:hover{background:#0F6FB2;}

.sidebar a.active{
background:white;
color:#1BA0E2;
font-weight:bold;
}

.main{
margin-left:220px;
padding:30px;
width:100%;
}

/* HEADER */
.header{
background:linear-gradient(90deg,#1BA0E2,#007bff);
color:white;
padding:15px 20px;
border-radius:12px;
display:flex;
justify-content:space-between;
align-items:center;
margin-bottom:25px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

/* CARD */
.card{
background:white;
padding:20px;
border-radius:15px;
box-shadow:0 5px 20px rgba(0,0,0,0.06);
margin-bottom:20px;
}

/* STAT BOX */
.stats{
display:grid;
grid-template-columns:repeat(3,1fr);
gap:20px;
margin-bottom:25px;
}

.stat-box{
padding:25px;
border-radius:15px;
color:white;
transition:0.3s;
}

.stat-box:hover{
transform:translateY(-5px);
}

.stat2{background:#28a745;}
.stat3{background:#ffc107;color:black;}
.stat4{background:#dc3545;}

.stat-box h3{
font-size:28px;
margin-bottom:8px;
}

.stat-box p{
font-size:14px;
}

/* CHART */
.chart-item{
margin-bottom:20px;
}

.chart-title{
display:flex;
justify-content:space-between;
margin-bottom:6px;
font-size:14px;
}

.progress{
height:12px;
background:#eee;
border-radius:10px;
overflow:hidden;
}

.progress-bar{
height:100%;
border-radius:10px;
transition:0.5s;
}

.bar1{background:#28a745;}
.bar2{background:#ffc107;}
.bar3{background:#dc3545;}

/* PROFILE */
.profile-icon{
background:white;
color:#1BA0E2;
width:35px;
height:35px;
display:flex;
align-items:center;
justify-content:center;
border-radius:50%;
cursor:pointer;
}

.dropdown{
display:none;
position:absolute;
background:white;
right:30px;
top:70px;
border-radius:8px;
box-shadow:0 5px 15px rgba(0,0,0,0.1);
}

.dropdown a{
display:block;
padding:10px;
text-decoration:none;
color:black;
}

.dropdown a:hover{background:#eee;}
</style>
</head>

<body>

<div class="wrapper">

<!-- SIDEBAR -->
<div class="sidebar">
<h2>Menu</h2>

<a class="<?= ($currentPage == 'dashboard.php') ? 'active' : '' ?>" href="dashboard.php">Dashboard</a>
<a href="alumni/alumni.php">Data Alumni</a>
<a href="pelacakan/pelacakan.php">Pelacakan</a>
<a href="hasil/hasil_pelacakan.php">Hasil</a>
</div>

<!-- MAIN -->
<div class="main">

<!-- HEADER -->
<div class="header">
<div><b>Sistem Pelacakan Alumni</b></div>

<div onclick="toggleMenu()" class="profile-icon">👤</div>
<div class="dropdown" id="menu">
<a href="logout.php">Logout</a>
</div>
</div>

<!-- STAT -->
<div class="stats">

<div class="stat-box stat2">
<h3><?= $terdeteksi ?></h3>
<p>Terdeteksi</p>
</div>

<div class="stat-box stat3">
<h3><?= $verifikasi ?></h3>
<p>Perlu Verifikasi</p>
</div>

<div class="stat-box stat4">
<h3><?= $tidak ?></h3>
<p>Tidak Ditemukan</p>
</div>

</div>

<!-- CHART -->
<div class="card">
<h3 style="margin-bottom:15px;">Statistik Pelacakan</h3>

<div class="chart-item">
<div class="chart-title">
<span>Terdeteksi</span>
<span><?= round(($terdeteksi/$total)*100) ?>%</span>
</div>
<div class="progress">
<div class="progress-bar bar1" style="width:<?= ($terdeteksi/$total)*100 ?>%"></div>
</div>
</div>

<div class="chart-item">
<div class="chart-title">
<span>Perlu Verifikasi</span>
<span><?= round(($verifikasi/$total)*100) ?>%</span>
</div>
<div class="progress">
<div class="progress-bar bar2" style="width:<?= ($verifikasi/$total)*100 ?>%"></div>
</div>
</div>

<div class="chart-item">
<div class="chart-title">
<span>Tidak Ditemukan</span>
<span><?= round(($tidak/$total)*100) ?>%</span>
</div>
<div class="progress">
<div class="progress-bar bar3" style="width:<?= ($tidak/$total)*100 ?>%"></div>
</div>
</div>

</div>

<!-- INFO -->
<div class="card">
Selamat datang di sistem pelacakan alumni 
</div>

</div>
</div>

<script>
function toggleMenu(){
let m=document.getElementById("menu");
m.style.display = (m.style.display=="block") ? "none" : "block";
}
</script>

</body>
</html>