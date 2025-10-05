<?php
session_start();

if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header("Location: index.php");
    exit;
}

$total = $_POST['total'];
$uang_bayar = $_POST['uang_bayar'];
$kembalian = $uang_bayar - $total;
$tanggal = date("d/m/Y H:i:s");
?>
<!DOCTYPE html>
<html>
<head>
  <title>Struk Pembelian - Kasir Apotek</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body class="container mt-4">
  <div class="struk">
    <h4>Apotek Terbaik</h4>
    <p><small><?= $tanggal ?></small></p>
    <table class="table table-borderless table-sm">
      <thead>
        <tr>
          <th>Obat</th>
          <th class="text-end">Subtotal</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($_SESSION['keranjang'] as $item): ?>
        <tr>
          <td><?= $item['nama'] ?> x<?= $item['jumlah'] ?></td>
          <td class="text-end">Rp<?= number_format($item['harga'] * $item['jumlah']) ?></td>
        </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
    <hr>
    <p>Total     : <span class="float-end">Rp<?= number_format($total) ?></span></p>
    <p>Bayar     : <span class="float-end">Rp<?= number_format($uang_bayar) ?></span></p>
    <p>Kembalian : <span class="float-end">Rp<?= number_format($kembalian) ?></span></p>
    <hr>
    <p style="text-align: center;">Terima kasih telah berbelanja!</p>
  </div>

  <div class="text-center mt-3 no-print">
    <a href="index.php" class="btn btn-primary">Transaksi Baru</a>
    <button onclick="window.print()" class="btn btn-success">🖨️ Cetak Struk</button>
  </div>

  <?php
  // Reset keranjang setelah transaksi selesai
  unset($_SESSION['keranjang']);
  ?>
</body>
</html>
