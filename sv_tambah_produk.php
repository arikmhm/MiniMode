<?php
require 'fungsi.php';

$kode_produk = mysqli_real_escape_string($koneksi, $_POST['kode_produk']);
$nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
$kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
$ukuran = mysqli_real_escape_string($koneksi, $_POST['ukuran']);
$stok = intval($_POST['stok']);
$harga = floatval($_POST['harga']);
$keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

// Cek apakah kode produk sudah ada
$check_query = "SELECT * FROM produk WHERE kode_produk = '$kode_produk'";
$check_result = mysqli_query($koneksi, $check_query);

if (mysqli_num_rows($check_result) > 0) {
    echo "Kode produk sudah terdaftar";
    exit;
}

$sql = "INSERT INTO produk (kode_produk, nama_produk, kategori, ukuran, stok, harga, keterangan) 
        VALUES ('$kode_produk', '$nama_produk', '$kategori', '$ukuran', $stok, $harga, '$keterangan')";

if (mysqli_query($koneksi, $sql)) {
    echo "success";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
?>