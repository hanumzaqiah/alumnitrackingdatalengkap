<?php
include "../koneksi.php";
error_reporting(E_ALL);

/* ================== HAPUS ================== */
if(isset($_GET['hapus'])){
    $id = $_GET['hapus'];
    mysqli_query($conn,"DELETE FROM hasil_pelacakan WHERE id='$id'");
    header("location:hasil_pelacakan.php");
    exit;
}

/* ================== UPDATE ================== */
if(isset($_POST['simpan'])){
    $id = $_POST['id'];

    $jenis = $_POST['jenis_pekerjaan'];
    $tempat = $_POST['tempat_bekerja'];

    /* ===== VALIDASI LOGIKA ===== */
    if($jenis == "PNS" && stripos($tempat, "PT") !== false){
        echo "<script>alert('PNS tidak boleh di perusahaan swasta!');history.back();</script>";
        exit;
    }

    if($jenis == "Swasta" && stripos($tempat, "Kementerian") !== false){
        echo "<script>alert('Swasta tidak boleh di instansi pemerintah!');history.back();</script>";
        exit;
    }

    /* ===== JIKA BELUM KERJA ===== */
    if($jenis == ""){
        $_POST['tempat_bekerja'] = "";
        $_POST['alamat_bekerja'] = "";
        $_POST['posisi'] = "";
    }

    mysqli_query($conn,"UPDATE hasil_pelacakan SET
        linkedin='".mysqli_real_escape_string($conn,$_POST['linkedin'])."',
        instagram='".mysqli_real_escape_string($conn,$_POST['instagram'])."',
        facebook='".mysqli_real_escape_string($conn,$_POST['facebook'])."',
        tiktok='".mysqli_real_escape_string($conn,$_POST['tiktok'])."',
        email='".mysqli_real_escape_string($conn,$_POST['email'])."',
        no_hp='".mysqli_real_escape_string($conn,$_POST['no_hp'])."',
        tempat_bekerja='".mysqli_real_escape_string($conn,$_POST['tempat_bekerja'])."',
        alamat_bekerja='".mysqli_real_escape_string($conn,$_POST['alamat_bekerja'])."',
        posisi='".mysqli_real_escape_string($conn,$_POST['posisi'])."',
        jenis_pekerjaan='".mysqli_real_escape_string($conn,$_POST['jenis_pekerjaan'])."',
        sosmed_perusahaan='".mysqli_real_escape_string($conn,$_POST['sosmed_perusahaan'])."'
        WHERE id='$id'
    ");

    header("location:hasil_pelacakan.php");
    exit;
}

/* ================== SEARCH ================== */
$search = isset($_GET['search']) ? $_GET['search'] : "";

$query = "SELECT hp.*, a.nama 
FROM hasil_pelacakan hp
JOIN alumni a ON hp.id_alumni = a.id
WHERE 
    a.nama LIKE '%$search%' OR
    hp.linkedin LIKE '%$search%' OR
    hp.instagram LIKE '%$search%' OR
    hp.facebook LIKE '%$search%' OR
    hp.email LIKE '%$search%' OR
    hp.tempat_bekerja LIKE '%$search%' OR
    hp.posisi LIKE '%$search%'
ORDER BY hp.id DESC";

$data = mysqli_query($conn,$query);

$edit_id = isset($_GET['edit']) ? $_GET['edit'] : "";

/* ================= LINK HELPER ================= */
function tampilLink($url){
    if(!$url) return "-";
    return "<a href='$url' target='_blank'>🔗</a>";
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Hasil Pelacakan Alumni</title>

<style>
body { font-family:'Segoe UI'; background:#eef3f8; margin:0; }
.header { background:linear-gradient(90deg,#1ba0e2,#007bff); color:white; padding:22px; text-align:center; font-size:26px; }
.card { background:white; margin:30px; padding:25px; border-radius:18px; box-shadow:0 6px 20px rgba(0,0,0,0.08); }

.top-bar {
    display:flex; justify-content:space-between; align-items:center;
    flex-wrap:wrap; gap:10px; margin-bottom:15px;
}

.button {
    background:#1ba0e2; color:white; padding:10px 18px;
    border-radius:10px; text-decoration:none;
}

.search-box input {
    padding:10px; border-radius:10px; border:1px solid #ccc;
}
.search-box button {
    padding:10px; border:none; border-radius:10px;
    background:#1ba0e2; color:white;
}

table { width:100%; border-collapse:collapse; font-size:13px; }
th { background:#1ba0e2; color:white; padding:12px; }
td { padding:10px; border-bottom:1px solid #eee; text-align:center; }

.valid { color:green; font-weight:600; }
.invalid { color:red; font-weight:600; }
.kosong { color:gray; }

</style>
</head>

<body>

<div class="header">Hasil Pelacakan Alumni</div>

<div class="card">

<div class="top-bar">
<a class="button" href="../dashboard.php">← Dashboard</a>

<form method="GET" class="search-box">
<input type="text" name="search" placeholder="Cari..." value="<?= $search ?>">
<button>Cari</button>
</form>
</div>

<table>
<tr>
<th>No</th>
<th>Nama</th>
<th>Pointer</th>
<th>LinkedIn</th>
<th>IG</th>
<th>FB</th>
<th>TikTok</th>
<th>Email</th>
<th>HP</th>
<th>Tempat</th>
<th>Alamat</th>
<th>Posisi</th>
<th>Jenis</th>
<th>Aksi</th>
</tr>

<?php
$no=1;

while($d=mysqli_fetch_assoc($data)){

if($edit_id==$d['id']){
?>

<form method="POST">
<tr>

<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>

<td><a href="<?= $d['pointer_bukti'] ?>" target="_blank">🔍</a></td>

<td><input name="linkedin" value="<?= $d['linkedin'] ?>"></td>
<td><input name="instagram" value="<?= $d['instagram'] ?>"></td>
<td><input name="facebook" value="<?= $d['facebook'] ?>"></td>
<td><input name="tiktok" value="<?= $d['tiktok'] ?>"></td>
<td><input name="email" value="<?= $d['email'] ?>"></td>
<td><input name="no_hp" value="<?= $d['no_hp'] ?>"></td>

<td><input name="tempat_bekerja" value="<?= $d['tempat_bekerja'] ?>"></td>
<td><input name="alamat_bekerja" value="<?= $d['alamat_bekerja'] ?>"></td>
<td><input name="posisi" value="<?= $d['posisi'] ?>"></td>

<td>
<select name="jenis_pekerjaan">
<option value="">Belum Kerja</option>
<option value="PNS" <?= $d['jenis_pekerjaan']=='PNS'?'selected':'' ?>>PNS</option>
<option value="Swasta" <?= $d['jenis_pekerjaan']=='Swasta'?'selected':'' ?>>Swasta</option>
<option value="Wirausaha" <?= $d['jenis_pekerjaan']=='Wirausaha'?'selected':'' ?>>Wirausaha</option>
</select>
</td>

<td>
<input type="hidden" name="id" value="<?= $d['id'] ?>">
<button name="simpan">💾</button>
<a href="hasil_pelacakan.php">❌</a>
</td>

</tr>
</form>

<?php
}else{

$jenis = $d['jenis_pekerjaan'];
$tempat = $d['tempat_bekerja'];

/* VALIDASI TAMPILAN */
if(!$jenis){
    $jenis_view = "<span class='kosong'>Belum Kerja</span>";
}
else if($jenis=="PNS" && stripos($tempat,"PT")!==false){
    $jenis_view = "<span class='invalid'>❌ Tidak Valid</span>";
}
else if($jenis=="Swasta" && stripos($tempat,"Kementerian")!==false){
    $jenis_view = "<span class='invalid'>❌ Tidak Valid</span>";
}
else{
    $jenis_view = "<span class='valid'>$jenis</span>";
}
?>

<tr>

<td><?= $no++ ?></td>
<td><?= $d['nama'] ?></td>

<td><a href="<?= $d['pointer_bukti'] ?>" target="_blank">🔍</a></td>

<td><?= tampilLink($d['linkedin']) ?></td>
<td><?= tampilLink($d['instagram']) ?></td>
<td><?= tampilLink($d['facebook']) ?></td>
<td><?= tampilLink($d['tiktok']) ?></td>

<td><?= $d['email'] ?: '-' ?></td>
<td><?= $d['no_hp'] ?: '-' ?></td>

<td><b><?= $d['tempat_bekerja'] ?: '-' ?></b></td>
<td><?= $d['alamat_bekerja'] ?: '-' ?></td>
<td><?= $d['posisi'] ?: '-' ?></td>

<td><?= $jenis_view ?></td>

<td>
<a href="?edit=<?= $d['id'] ?>">✏️</a>
<a href="?hapus=<?= $d['id'] ?>" onclick="return confirm('Hapus?')">🗑️</a>
</td>

</tr>

<?php } } ?>

</table>

</div>

</body>
</html>