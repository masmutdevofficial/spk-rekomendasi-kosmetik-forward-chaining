<?php include __DIR__ . '/config/koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Simulasi Forward Chaining</title>
  <link href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .produk-card {
      border-radius: 12px;
      box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      margin-bottom: 20px;
    }
    .produk-card img {
      border-radius: 8px;
      margin-bottom: 10px;
    }
    .produk-card h5 {
      color: #007bff;
    }
  </style>
</head>

<body>
<div class="container mt-5 mb-5">
  <h3 class="mb-4">🔎 Simulasi Rekomendasi Produk (Forward Chaining)</h3>

  <form method="POST">
    <?php
    $fakta = mysqli_query($connect, "SELECT * FROM tb_fakta WHERE aktif='Ya' ORDER BY id ASC LIMIT 4");
    while ($f = mysqli_fetch_array($fakta)) {
      $kategori = $f['kategori'];
      echo "<div class='form-group'>";
      echo "<label><strong>{$f['pertanyaan']}</strong></label>";

      $opsi = mysqli_query($connect, "SELECT DISTINCT `$kategori` FROM tb_rule WHERE `$kategori` IS NOT NULL AND `$kategori` != '' ORDER BY `$kategori` ASC");
      echo "<select class='form-control' name='{$kategori}' required>";
      echo "<option value=''>-- Pilih --</option>";
      while ($o = mysqli_fetch_array($opsi)) {
        $val = $o[$kategori];
        echo "<option value='$val'>$val</option>";
      }
      echo "</select></div>";
    }
    ?>
    <button type="submit" name="cari" class="btn btn-primary">Tampilkan Rekomendasi</button>
  </form>

  <?php
  if (isset($_POST['cari'])) {
    $jenis_kulit     = $_POST['jenis_kulit'];
    $masalah_kulit   = $_POST['masalah_kulit'];
    $efek            = $_POST['efek'];
    $bebas_alkohol   = $_POST['bebas_alkohol'];

    // Ambil semua rule yang cocok
    $rule = mysqli_query($connect, "
      SELECT * FROM tb_rule 
      WHERE jenis_kulit = '$jenis_kulit'
        AND masalah_kulit = '$masalah_kulit'
        AND efek = '$efek'
        AND bebas_alkohol = '$bebas_alkohol'
    ");

    if (mysqli_num_rows($rule) > 0) {
      echo "<h5 class='mt-4 mb-3'>🎯 Produk yang cocok dengan preferensi Anda:</h5>";

      while ($r = mysqli_fetch_array($rule)) {
        $produk_id = $r['produk_id'];

        // Ambil produk terkait
        $produk = mysqli_query($connect, "SELECT * FROM tb_produk WHERE id = $produk_id");
        if ($p = mysqli_fetch_array($produk)) {

          // Simpan ke tb_masukan
          mysqli_query($connect, "
            INSERT INTO tb_masukan (jenis_kulit, masalah_kulit, efek, bebas_alkohol, produk_id)
            VALUES ('$jenis_kulit', '$masalah_kulit', '$efek', '$bebas_alkohol', '$produk_id')
          ");
  ?>
      <div class="card produk-card">
        <div class="card-body">
          <div class="row">
            <?php if (!empty($p['gambar'])): ?>
              <div class="col-md-4 text-center">
                <img src="uploads/<?= $p['gambar']; ?>" width="100%" alt="Gambar Produk">
              </div>
            <?php endif; ?>
            <div class="<?= empty($p['gambar']) ? 'col-md-12' : 'col-md-8' ?>">
              <h5><?= $p['nama']; ?></h5>
              <p><strong>Merek:</strong> <?= $p['merek'] ?: '-'; ?></p>
              <p><strong>Perusahaan:</strong> <?= $p['perusahaan'] ?: '-'; ?></p>
              <p><strong>Harga:</strong> <?= $p['harga'] ? 'Rp ' . number_format($p['harga'], 2, ',', '.') : '-'; ?></p>
              <p><strong>Kandungan:</strong> <?= $p['kandungan'] ?: '-'; ?></p>
              <p><strong>Deskripsi:</strong> <?= $p['deskripsi'] ?: '-'; ?></p>
              <p><strong>Cara Penggunaan:</strong> <?= $p['cara_penggunaan'] ?: '-'; ?></p>
              <p class="text-muted"><small>Dibuat pada: <?= date('d-m-Y H:i', strtotime($p['created_at'])); ?></small></p>
            </div>
          </div>
        </div>
      </div>
  <?php
        }
      }
    } else {
      echo "<div class='alert alert-warning mt-4'>❌ Tidak ditemukan produk yang cocok.</div>";
    }
  }
  ?>
</div>
</body>
</html>
