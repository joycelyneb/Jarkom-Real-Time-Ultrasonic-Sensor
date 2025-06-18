<?php
// Konfigurasi koneksi database
$servername = "localhost";
$username = "root";
$password = ""; // default password kosong di XAMPP
$dbname = "sensor_db";

// Cek apakah parameter distance dikirim
if (isset($_GET['distance'])) {
    $distance = $_GET['distance'];

    // Validasi sederhana (pastikan angka)
    if (!is_numeric($distance)) {
        echo "Parameter 'distance' harus berupa angka!";
        exit;
    }

    // Buat koneksi ke database
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Simpan ke tabel data_ultrasonik
    $sql = "INSERT INTO data_ultrasonik (distance) VALUES ('$distance')";
    
    if ($conn->query($sql) === TRUE) {
        echo "Data berhasil disimpan: $distance cm";
    } else {
        echo "Error saat menyimpan: " . $conn->error;
    }

    // Tutup koneksi
    $conn->close();

} else {
    // Jika parameter tidak ditemukan
    echo "Parameter 'distance' tidak ditemukan. Gunakan format: insert.php?distance=123.4";
}
?>
