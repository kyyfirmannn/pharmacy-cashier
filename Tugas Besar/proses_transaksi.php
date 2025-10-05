<?php
session_start();
include 'data_obat.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_obat = $_POST['id_obat'];
    $jumlah = $_POST['jumlah'];

    foreach ($obat as $item) {
        if ($item['id'] == $id_obat) {
            $data_obat = [
                'id' => $item['id'],
                'nama' => $item['nama'],
                'harga' => $item['harga'],
                'gambar' => $item['gambar'],
                'jumlah' => $jumlah
            ];
            // Tambahkan ke keranjang
            $_SESSION['keranjang'][] = $data_obat;
            break;
        }
    }
}

// Kembali ke halaman utama
header("Location: index.php");
exit;
