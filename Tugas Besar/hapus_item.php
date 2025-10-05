<?php
session_start();

if (isset($_GET['key'])) {
    $key = $_GET['key'];

    // Cek apakah keranjang ada dan key-nya valid
    if (isset($_SESSION['keranjang'][$key])) {
        unset($_SESSION['keranjang'][$key]);

        // Susun ulang index array biar rapih
        $_SESSION['keranjang'] = array_values($_SESSION['keranjang']);
    }
}

header('Location: index.php');
exit;
