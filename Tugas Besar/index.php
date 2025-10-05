<?php
session_start();
include 'data_obat.php';
?>
<!DOCTYPE html>
<html>
<head>
  <title>Kasir Apotek</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
</head>
<body class="container mt-4">
  <img src="img/logo_apotek.webp" alt="Logo Apotek Rizky" style="height: 70px;">
  <h2 class="mt-2">Kasir Apotek</h2>

  <!-- Form Tambah Obat -->
  <form action="proses_transaksi.php" method="POST" class="row g-3 mt-3">
    <div class="col-md-6">
      <label for="id_obat" class="form-label">Pilih Obat</label>
      <select name="id_obat" id="id_obat" class="form-select" required>
        <?php foreach ($obat as $item): ?>
          <option value="<?= $item['id'] ?>">
            <?= $item['nama'] ?> - Rp<?= number_format($item['harga']) ?>
          </option>
        <?php endforeach; ?>
      </select>
    </div>
    <div class="col-md-3">
      <label for="jumlah" class="form-label">Jumlah</label>
      <input type="number" name="jumlah" id="jumlah" class="form-control" min="1" required>
    </div>
    <div class="col-md-3 d-grid">
      <label class="form-label">&nbsp;</label>
      <button type="submit" class="btn btn-success">Tambah ke Keranjang</button>
    </div>
  </form>

  <hr>

  <!-- Tabel Keranjang -->
  <h4>Keranjang Belanja</h4>
  <?php if (!empty($_SESSION['keranjang'])): ?>
    <table class="table table-bordered align-middle">
      <thead>
        <tr>
          <th>Obat</th>
          <th>Harga</th>
          <th>Jumlah</th>
          <th>Subtotal</th>
          <th>Aksi</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $total = 0;
          foreach ($_SESSION['keranjang'] as $key => $item):
            $subtotal = $item['harga'] * $item['jumlah'];
            $total += $subtotal;
        ?>
        <tr>
          <td>
            <img src="img/<?= $item['gambar'] ?>" alt="<?= $item['nama'] ?>" style="height: 40px; margin-right: 10px;">
            <?= $item['nama'] ?>
          </td>
          <td>Rp<?= number_format($item['harga']) ?></td>
          <td><?= $item['jumlah'] ?></td>
          <td>Rp<?= number_format($subtotal) ?></td>
          <td>
            <a href="hapus_item.php?key=<?= $key ?>" class="btn btn-danger btn-sm">Hapus</a>
          </td>
        </tr>
        <?php endforeach; ?>
        <tr>
          <th colspan="3">Total</th>
          <th colspan="2">Rp<?= number_format($total) ?></th>
        </tr>
      </tbody>
    </table>
    <a href="bayar.php" class="btn btn-primary">Lanjut ke Pembayaran</a>
  <?php else: ?>
    <p>Keranjang masih kosong.</p>
  <?php endif; ?>

</body>
</html>
