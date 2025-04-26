<?php
// Konfigurasi koneksi ke database
$host = '';
$username = '';
$password = '';
$database = '';

// Membuat koneksi
$conn = new mysqli($host, $username, $password, $database);

// Cek koneksi
if ($conn->connect_error) {
    http_response_code(500);
    echo json_encode(["error" => "Koneksi gagal"]);
    exit();
}

// Query ambil data produk
$sql = "SELECT nama, harga, link_gambar FROM produk";
$result = $conn->query($sql);

$produk = [];

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $produk[] = $row;
    }
}

// Tutup koneksi
$conn->close();

// Set header JSON
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: Content-Type");
header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
header('Content-Type: application/json');
echo json_encode($produk);
?>
