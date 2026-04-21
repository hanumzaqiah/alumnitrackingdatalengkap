<?php 
include "../koneksi.php";

ini_set('display_errors', 1);
error_reporting(E_ALL);

/* 🔥 HAPUS SEMUA DATA (TRUNCATE) */
if(isset($_POST['hapus_dulu'])){
    mysqli_query($conn, "TRUNCATE TABLE alumni");

    echo "<script>
    alert('Semua data alumni berhasil dihapus!');
    window.location='alumni.php';
    </script>";
    exit;
}

/* 🔥 IMPORT CSV */
if(isset($_POST['import'])){

    // VALIDASI FILE HARUS CSV
    $file_name = $_FILES['file_excel']['name'];
    $ext = pathinfo($file_name, PATHINFO_EXTENSION);

    if($ext != "csv"){
        echo "<script>alert('Upload file CSV saja!');history.back();</script>";
        exit;
    }

    $file = $_FILES['file_excel']['tmp_name'];

    // OPSIONAL: HAPUS DATA LAMA DULU
    mysqli_query($conn, "TRUNCATE TABLE alumni");

    $handle = fopen($file, "r");

    $no = 0;
    while(($row = fgetcsv($handle, 1000, ",")) !== FALSE){

        if($no == 0){ 
            $no++; 
            continue; // skip header
        }

        // AMBIL DATA SESUAI KOLOM CSV
        $nama = mysqli_real_escape_string($conn, $row[0] ?? '');
        $nim = mysqli_real_escape_string($conn, $row[1] ?? '');
        $tahun_masuk = mysqli_real_escape_string($conn, $row[2] ?? '');
        $tanggal_lulus = mysqli_real_escape_string($conn, $row[3] ?? '');
        $fakultas = mysqli_real_escape_string($conn, $row[4] ?? '');
        $program_studi = mysqli_real_escape_string($conn, $row[5] ?? '');

        // DEFAULT
        $status = "Belum Dilacak";
        $persentase = 0;

        // SKIP DATA KOSONG
        if(empty($nama) || $nama == "0") continue;

        // FORMAT TANGGAL
        if($tanggal_lulus != ""){
            $tanggal_lulus = date('Y-m-d', strtotime($tanggal_lulus));
        }

        // INSERT
        mysqli_query($conn,"INSERT INTO alumni 
        (nama, nim, tahun_masuk, tanggal_lulus, fakultas, program_studi, status, persentase)
        VALUES 
        ('$nama','$nim','$tahun_masuk','$tanggal_lulus','$fakultas','$program_studi','$status','$persentase')");
    }

    fclose($handle);

    echo "<script>
    alert('Import berhasil!');
    window.location='alumni.php';
    </script>";
}
?>