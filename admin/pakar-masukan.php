<?php include __DIR__ . '/../auth/check.php';
include __DIR__ . '/../config/koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Masukan Pengguna</title>
  <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="../assets/css/dashboard.css" rel="stylesheet">
</head>

<body>
<nav class="navbar navbar-dark fixed-top bg-info flex-md-nowrap p-0 shadow">
  <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Dashboard Pakar</a>
  <ul class="navbar-nav px-3">
    <li class="nav-item text-nowrap">
      <a class="nav-link" href="proseslogout.php">Sign out</a>
    </li>
  </ul>
</nav>

<div class="container-fluid">
  <div class="row">
    <?php include 'pakar-sidebar.php'; ?>

    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <h4 class="mt-4 mb-4">Data Masukan Pengguna</h4>

      <div class="card">
        <div class="card-header">Riwayat Masukan & Rekomendasi Produk</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Kulit</th>
                <th>Masalah Kulit</th>
                <th>Tekstur</th>
                <th>Efek</th>
                <th>Opsi</th>
                <th>Rekomendasi Produk</th>
                <th>Waktu</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = mysqli_query($connect, "
                SELECT m.*, p.nama AS nama_produk 
                FROM tb_masukan m 
                LEFT JOIN tb_produk p ON m.produk_id = p.id 
                ORDER BY m.created_at DESC
              ");
              if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['jenis_kulit']; ?></td>
                <td><?= $row['masalah_kulit']; ?></td>
                <td><?= !empty($row['tekstur']) ? htmlspecialchars($row['tekstur']) : '-'; ?></td>
                <td><?= !empty($row['efek']) ? htmlspecialchars($row['efek']) : '-'; ?></td>
                <td>
                  <?= (isset($row['bebas_alkohol']) && $row['bebas_alkohol'] === 'Ya') ? 'Bebas Alkohol<br>' : '' ?>
                  <?= (isset($row['fragrance_free']) && $row['fragrance_free'] === 'Ya') ? 'Fragrance-Free<br>' : '' ?>
                  <?= (isset($row['vegan']) && $row['vegan'] === 'Ya') ? 'Vegan<br>' : '' ?>
                  <?= (isset($row['produk_lokal']) && $row['produk_lokal'] === 'Ya') ? 'Produk Lokal' : '' ?>
                </td>
                <td><?= $row['nama_produk'] ?: '<i>Produk tidak ditemukan</i>'; ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
              </tr>
              <?php 
                }
              } else {
                echo '<tr><td colspan="8" class="text-center">Belum ada masukan pengguna</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
</body>
</html>
