<?php
include "../koneksi.php";

if(!isset($_GET['id'])){
    header("location:pelacakan.php");
    exit;
}

$id = mysqli_real_escape_string($conn, $_GET['id']);

/* ================= AMBIL DATA ================= */
$data = mysqli_query($conn,"SELECT * FROM alumni WHERE id='$id'");
$alumni = mysqli_fetch_assoc($data);

if(!$alumni){
    header("location:pelacakan.php");
    exit;
}

/* ================= CEK SUDAH ADA ================= */
$cek = mysqli_query($conn,"SELECT * FROM hasil_pelacakan WHERE id_alumni='$id'");
if(mysqli_num_rows($cek) > 0){
    header("location:pelacakan.php");
    exit;
}

/* ================= KEYWORD ================= */
$nama = $alumni['nama'];
$keyword = $nama." Universitas Muhammadiyah Malang";

/* ================= POINTER ================= */
$pointer = "https://www.google.com/search?q=".urlencode($keyword);

/* ================= AUTO GENERATE ================= */
$username = strtolower(str_replace(" ","", $nama));

$email = $username."@gmail.com";
$no_hp = "08".rand(111111111,999999999);

$linkedin = "https://www.linkedin.com/in/".$username;
$instagram = "https://instagram.com/".$username;
$facebook = "https://facebook.com/".$username;
$tiktok = "https://tiktok.com/@".$username;

/* ================= DATA PEKERJAAN ================= */

$status_random = rand(1,100);

$tempat_bekerja = "";
$alamat_bekerja = "";
$posisi = "";
$jenis_pekerjaan = NULL; // 🔥 WAJIB NULL (bukan "")

/*
    1 - 30  = BELUM KERJA
    31 - 60 = SWASTA
    61 - 80 = PNS
    81 - 100 = WIRAUSAHA
*/

if($status_random <= 30){

    // BELUM KERJA → tetap NULL

}else if($status_random <= 60){

    // SWASTA
    $jenis_pekerjaan = "Swasta";

    $q1 = mysqli_query($conn,"SELECT nama_perusahaan FROM perusahaan ORDER BY RAND() LIMIT 1");
    $perusahaan = mysqli_fetch_assoc($q1);

    $q2 = mysqli_query($conn,"SELECT nama_posisi FROM posisi ORDER BY RAND() LIMIT 1");
    $pos = mysqli_fetch_assoc($q2);

    $tempat_bekerja = $perusahaan['nama_perusahaan'] ?? "Perusahaan";
    $posisi = $pos['nama_posisi'] ?? "Staff";
    $alamat_bekerja = "Indonesia";

}else if($status_random <= 80){

    // PNS
    $jenis_pekerjaan = "PNS";

    $q = mysqli_query($conn,"SELECT nama_instansi FROM instansi ORDER BY RAND() LIMIT 1");
    $instansi = mysqli_fetch_assoc($q); // 🔥 FIX: jangan pakai $d lagi

    $tempat_bekerja = $instansi['nama_instansi'] ?? "Instansi Pemerintah";
    $posisi = "Staff Pemerintahan";
    $alamat_bekerja = "Indonesia";

}else{

    // WIRAUSAHA
    $jenis_pekerjaan = "Wirausaha";
    $tempat_bekerja = "Usaha Mandiri";
    $posisi = "Owner";
    $alamat_bekerja = "Indonesia";
}

/* ================= LOGIKA PERSENTASE ================= */

if($jenis_pekerjaan === NULL){
    $persentase = 60;
    $status = "Belum Terdeteksi";
}else{
    $persentase = 100;
    $status = "Terdeteksi";
}

/* ================= HANDLE NULL ENUM ================= */
$jenis_sql = $jenis_pekerjaan === NULL ? "NULL" : "'$jenis_pekerjaan'";

/* ================= INSERT ================= */
mysqli_query($conn,"INSERT INTO hasil_pelacakan
(id_alumni, linkedin, instagram, facebook, tiktok, email, no_hp, tempat_bekerja, alamat_bekerja, posisi, jenis_pekerjaan, sosmed_perusahaan, pointer_bukti)
VALUES
('$id',
'".mysqli_real_escape_string($conn,$linkedin)."',
'".mysqli_real_escape_string($conn,$instagram)."',
'".mysqli_real_escape_string($conn,$facebook)."',
'".mysqli_real_escape_string($conn,$tiktok)."',
'".mysqli_real_escape_string($conn,$email)."',
'".mysqli_real_escape_string($conn,$no_hp)."',
'".mysqli_real_escape_string($conn,$tempat_bekerja)."',
'".mysqli_real_escape_string($conn,$alamat_bekerja)."',
'".mysqli_real_escape_string($conn,$posisi)."',
$jenis_sql,
'',
'".mysqli_real_escape_string($conn,$pointer)."'
)");

/* ================= UPDATE STATUS ================= */
mysqli_query($conn,"UPDATE alumni 
SET status='$status', persentase='$persentase'
WHERE id='$id'");

header("location:pelacakan.php");
exit;
?>