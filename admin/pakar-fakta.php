<?php include __DIR__ . '/../auth/check.php';
include __DIR__ . '/../config/koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Fakta / Pertanyaan</title>
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
      <h4 class="mt-4 mb-4">Data Fakta / Pertanyaan</h4>

      <!-- Form Tambah Fakta -->
      <div class="card mb-4">
        <div class="card-header">Tambah Fakta</div>
        <div class="card-body">
          <form method="POST">
            <div class="form-group">
              <label>Kode Fakta</label>
              <input type="text" name="kode" class="form-control" placeholder="Misal: F1, F2" required>
            </div>
            <div class="form-group">
              <label>Pertanyaan</label>
              <textarea name="pertanyaan" class="form-control" rows="2" placeholder="Masukkan teks pertanyaan" required></textarea>
            </div>
            <div class="form-group">
              <label>Kategori</label>
              <select name="kategori" class="form-control" required>
                <option value="">-- Pilih Kategori --</option>
                <option value="jenis_kulit">Jenis Kulit</option>
                <option value="masalah_kulit">Masalah Kulit</option>
                <option value="efek">Efek</option>
                <option value="bebas_alkohol">Bebas Alkohol</option>
              </select>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan Fakta</button>
          </form>
        </div>
      </div>

      <!-- Tabel Fakta -->
      <div class="card">
        <div class="card-header">Daftar Fakta</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Kode</th>
                <th>Pertanyaan</th>
                <th>Kategori</th>
                <th>Status</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $query = mysqli_query($connect, "SELECT * FROM tb_fakta ORDER BY id ASC");
              if (mysqli_num_rows($query) > 0) {
                while ($row = mysqli_fetch_array($query)) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['kode']; ?></td>
                <td><?= $row['pertanyaan']; ?></td>
                <td><?= ucfirst(str_replace('_', ' ', $row['kategori'])); ?></td>
                <td>
                  <span class="badge badge-<?= $row['aktif'] == 'Ya' ? 'success' : 'secondary'; ?>">
                    <?= $row['aktif']; ?>
                  </span>
                </td>
                <td>
                  <button type="button" class="btn btn-sm btn-secondary btn-edit-fakta"
                    data-id="<?= $row['id']; ?>"
                    data-kode="<?= htmlspecialchars($row['kode'], ENT_QUOTES); ?>"
                    data-pertanyaan="<?= htmlspecialchars($row['pertanyaan'], ENT_QUOTES); ?>"
                    data-kategori="<?= $row['kategori']; ?>"
                    data-aktif="<?= $row['aktif']; ?>"
                  >Edit</button>

                  <form method="post" action="actions.php" style="display:inline">
                    <input type="hidden" name="action" value="delete_fakta">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus fakta ini?')">Hapus</button>
                  </form>
                </td>
              </tr>
              <?php 
                }
              } else {
                echo '<tr><td colspan="6" class="text-center">Belum ada data fakta</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Edit Fakta Modal -->
<div class="modal fade" id="editFaktaModal" tabindex="-1" role="dialog" aria-labelledby="editFaktaLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="actions.php">
        <div class="modal-header">
          <h5 class="modal-title" id="editFaktaLabel">Edit Fakta</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" value="edit_fakta">
          <input type="hidden" name="id" value="" />
          <div class="form-group">
            <label>Kode Fakta</label>
            <input type="text" name="kode" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Pertanyaan</label>
            <textarea name="pertanyaan" class="form-control" rows="2" required></textarea>
          </div>
          <div class="form-group">
            <label>Kategori</label>
            <select name="kategori" class="form-control" required>
              <option value="jenis_kulit">Jenis Kulit</option>
              <option value="masalah_kulit">Masalah Kulit</option>
              <option value="efek">Efek</option>
              <option value="bebas_alkohol">Bebas Alkohol</option>
            </select>
          </div>
          <div class="form-group">
            <label>Status Aktif</label>
            <select name="aktif" class="form-control">
              <option value="Ya">Ya</option>
              <option value="Tidak">Tidak</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
          <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
        </div>
      </form>
    </div>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<script>
  (function(){
    document.querySelectorAll('.btn-edit-fakta').forEach(function(btn){
      btn.addEventListener('click', function(){
        var id = this.getAttribute('data-id');
        var kode = this.getAttribute('data-kode');
        var pertanyaan = this.getAttribute('data-pertanyaan');
        var kategori = this.getAttribute('data-kategori');
        var aktif = this.getAttribute('data-aktif');

        var modal = document.getElementById('editFaktaModal');
        modal.querySelector('input[name="id"]').value = id;
        modal.querySelector('input[name="kode"]').value = kode;
        modal.querySelector('textarea[name="pertanyaan"]').value = pertanyaan;
        modal.querySelector('select[name="kategori"]').value = kategori;
        modal.querySelector('select[name="aktif"]').value = aktif;

        $('#editFaktaModal').modal('show');
      });
    });
  })();
</script>

<script src="https://unpkg.com/feather-icons"></script>
<script>feather.replace()</script>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
  $kode = trim($_POST['kode']);
  $pertanyaan = trim($_POST['pertanyaan']);
  $kategori = $_POST['kategori'];

  $cek = mysqli_query($connect, "SELECT * FROM tb_fakta WHERE kode = '$kode'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Kode fakta sudah digunakan!');</script>";
  } else {
    $insert = mysqli_query($connect, "INSERT INTO tb_fakta (kode, pertanyaan, kategori) VALUES ('$kode', '$pertanyaan', '$kategori')");
    if ($insert) {
      echo "<script>alert('Fakta berhasil disimpan!'); window.location='pakar-fakta.php';</script>";
    } else {
      echo "<script>alert('Gagal menyimpan fakta');</script>";
    }
  }
}
?>
