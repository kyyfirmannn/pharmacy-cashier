<?php
session_start();
if (!isset($_SESSION['keranjang']) || empty($_SESSION['keranjang'])) {
    header("Location: index.php");
    exit;
}

// Hitung total harga
$total = 0;
foreach ($_SESSION['keranjang'] as $item) {
    $total += $item['harga'] * $item['jumlah'];
}
?>
<!DOCTYPE html>
<html>
<head>
  <title>Pembayaran - Kasir Apotek Rizky</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body class="container mt-4">
  <h2>Pembayaran</h2>

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>Obat</th>
        <th>Harga</th>
        <th>Jumlah</th>
        <th>Subtotal</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($_SESSION['keranjang'] as $item): ?>
        <tr>
          <td><?= $item['nama'] ?></td>
          <td>Rp<?= number_format($item['harga']) ?></td>
          <td><?= $item['jumlah'] ?></td>
          <td>Rp<?= number_format($item['harga'] * $item['jumlah']) ?></td>
        </tr>
      <?php endforeach; ?>
      <tr>
        <th colspan="3">Total</th>
        <th>Rp<?= number_format($total) ?></th>
      </tr>
    </tbody>
  </table>

  
  <form action="struk.php" method="POST" class="mt-4">
    <div class="mb-3">
      <label for="uang_bayar" class="form-label">Uang Dibayarkan</label>
      <input type="number" name="uang_bayar" id="uang_bayar" class="form-control" min="<?= $total ?>" required>
    </div>
    <input type="hidden" name="total" value="<?= $total ?>">
    <button type="submit" class="btn btn-primary">Cetak Struk</button>
    <a href="index.php" class="btn btn-secondary">Batal</a>
  </form>
</body>
</html>
