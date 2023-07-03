<?php
$host = 'localhost';
$db = 'id20870100_esp_data';
$user = 'id20870100_esp_board';
$pass = '/!K/[a2nX_JuZsJQ';

// Melakukan koneksi ke database
$connection = new mysqli($host, $user, $pass, $db); 

// Memeriksa koneksi
if ($connection->connect_error) {
    die("Koneksi gagal: " . $connection->connect_error);
}

// Mengambil data dari form login
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan query untuk memeriksa apakah pengguna terdaftar di database
$query = "SELECT * FROM registration WHERE username = '$username' AND password = '$password'";
$result = $connection->query($query);

if ($result->num_rows > 0) {
    // Pengguna terdaftar, berikan akses ke halaman utama
    header("Location: halaman_awal.php");
    exit();
    
} else {
    // Pengguna tidak terdaftar, tampilkan pesan error
    echo "Username atau password salah.";
}

$connection->close();
?>