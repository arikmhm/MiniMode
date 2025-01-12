<?php
require "fungsi.php";

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = intval($_POST['id']);
    $nama_produk = mysqli_real_escape_string($koneksi, $_POST['nama_produk']);
    $kategori = mysqli_real_escape_string($koneksi, $_POST['kategori']);
    $ukuran = mysqli_real_escape_string($koneksi, $_POST['ukuran']);
    $stok = intval($_POST['stok']);
    $harga = floatval($_POST['harga']);
    $keterangan = mysqli_real_escape_string($koneksi, $_POST['keterangan']);

    if (empty($nama_produk) || empty($kategori) || empty($ukuran) || $stok < 0 || $harga < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Data tidak valid!']);
        exit;
    }

    $stmt = $koneksi->prepare("UPDATE produk SET 
        nama_produk = ?, 
        kategori = ?,
        ukuran = ?,
        stok = ?,
        harga = ?,
        keterangan = ?
        WHERE id = ?");

    $stmt->bind_param("sssiisi", 
        $nama_produk,
        $kategori,
        $ukuran,
        $stok,
        $harga,
        $keterangan,
        $id
    );

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success', 'message' => 'Data berhasil diperbarui']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Gagal memperbarui data: ' . $stmt->error]);
    }

    $stmt->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>