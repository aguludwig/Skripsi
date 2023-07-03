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

// Mengambil data dari form register
$username = $_POST['username'];
$password = $_POST['password'];

// Melakukan query untuk menyimpan pengguna baru ke database
$query = "INSERT INTO registration (username, password) VALUES ('$username', '$password')";
if ($connection->query($query) === TRUE) {
    header("Location: index.html");
    exit();
} else {
    echo "Error: " . $query . "<br>" . $connection->error;
}

$connection->close();
?>
