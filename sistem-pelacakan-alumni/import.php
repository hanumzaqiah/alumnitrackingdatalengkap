<?php
include 'koneksi.php';

require 'spreadsheet-reader/php-excel-reader/excel_reader2.php';
require 'spreadsheet-reader/SpreadsheetReader.php';
?>

<!DOCTYPE html>
<html>
<head>
    <title>Import Data Alumni</title>
</head>
<body>

<h2>Import Data Alumni dari Excel</h2>

<form method="POST" enctype="multipart/form-data">
    <input type="file" name="file_excel" required>
    <button type="submit" name="import">Import</button>
</form>

<br>

<?php

if (isset($_POST['import'])) {

    echo "<h3>DEBUG MODE</h3>";

    // CEK FILE
    echo "<pre>";
    print_r($_FILES);
    echo "</pre>";

    if ($_FILES['file_excel']['error'] == 0) {

        $file = $_FILES['file_excel']['tmp_name'];
        $reader = new SpreadsheetReader($file);

        $berhasil = 0;
        $gagal = 0;

        foreach ($reader as $index => $row) {

            if ($index == 0) continue; // skip header

            echo "<hr>";
            echo "<b>Data Baris ke-$index:</b><br>";
            echo "<pre>";
            print_r($row);
            echo "</pre>";

            // CEK DATA KOSONG
            if (empty($row[0]) || empty($row[1])) {
                echo "Lewati baris kosong<br>";
                continue;
            }

            // AMBIL DATA SESUAI EXCEL
            $nama = mysqli_real_escape_string($conn, $row[0]);
            $nim = mysqli_real_escape_string($conn, $row[1]);
            $tahun_masuk = mysqli_real_escape_string($conn, $row[2]);

            // 🔥 FIX TANGGAL
            $tanggal_lulus = !empty($row[3]) 
                ? date('Y-m-d', strtotime($row[3])) 
                : NULL;

            $fakultas = mysqli_real_escape_string($conn, $row[4]);
            $program_studi = mysqli_real_escape_string($conn, $row[5]);

            $status = "Belum Terlacak";
            $persentase = 0;

            // QUERY
            $query = "INSERT INTO alumni 
            (nama, nim, tahun_masuk, tanggal_lulus, fakultas, program_studi, status, persentase)
            VALUES 
            ('$nama','$nim','$tahun_masuk','$tanggal_lulus','$fakultas','$program_studi','$status','$persentase')";

            if(mysqli_query($conn, $query)){
                echo "<span style='color:green;'>BERHASIL: $nama</span><br>";
                $berhasil++;
            } else {
                echo "<span style='color:red;'>ERROR: " . mysqli_error($conn) . "</span><br>";
                $gagal++;
            }
        }

        echo "<hr>";
        echo "<h3>HASIL IMPORT</h3>";
        echo "Berhasil: $berhasil <br>";
        echo "Gagal: $gagal";

    } else {
        echo "Gagal upload file!";
    }
}
?>

</body>
</html>