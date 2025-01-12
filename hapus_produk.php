<?php
require "fungsi.php";

header('Content-Type: application/json');

if (!isset($_POST['id'])) {
    echo json_encode([
        'status' => 'error', 
        'message' => 'ID tidak ditemukan'
    ]);
    exit;
}

// Ambil ID produk menggunakan prepared statement untuk verifikasi
$stmt_select = $koneksi->prepare("SELECT id FROM produk WHERE id = ?");
$id = intval($_POST["id"]);
$stmt_select->bind_param("i", $id);
$stmt_select->execute();
$result = $stmt_select->get_result();

if ($result && $result->num_rows > 0) {
    // Gunakan prepared statement untuk menghapus data produk
    $stmt_delete = $koneksi->prepare("DELETE FROM produk WHERE id = ?");
    $stmt_delete->bind_param("i", $id);

    try {
        $koneksi->begin_transaction(); // Mulai transaksi

        if ($stmt_delete->execute()) {
            $koneksi->commit(); // Commit transaksi
            echo json_encode([
                'status' => 'success', 
                'message' => 'Data produk berhasil dihapus'
            ]);
        } else {
            $koneksi->rollback(); // Rollback jika gagal
            echo json_encode([
                'status' => 'error', 
                'message' => 'Gagal menghapus data produk'
            ]);
        }
    } catch (Exception $e) {
        $koneksi->rollback(); // Rollback jika terjadi kesalahan
        echo json_encode([
            'status' => 'error', 
            'message' => 'Terjadi kesalahan: ' . $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error', 
        'message' => 'Data produk tidak ditemukan'
    ]);
}

// Tutup prepared statements
$stmt_select->close();
$stmt_delete->close();
?>