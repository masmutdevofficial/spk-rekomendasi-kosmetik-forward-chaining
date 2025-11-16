<?php include __DIR__ . '/../auth/check.php';
include __DIR__ . '/../config/koneksi.php'; ?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Aturan (Rules)</title>
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
      <h4 class="mt-4 mb-4">Data Aturan (Rules)</h4>

      <!-- Form Tambah Rule -->
      <div class="card mb-4">
        <div class="card-header">Tambah Rule</div>
        <div class="card-body">
          <form method="POST" action="">
            <div class="row">
              <div class="form-group col-md-12">
                <label>Pilih Produk</label>
                <select name="produk_id" class="form-control" required>
                  <option value="">Pilih Produk</option>
                  <?php
                  $produk = mysqli_query($connect, "SELECT id, nama FROM tb_produk ORDER BY nama ASC");
                  while ($p = mysqli_fetch_array($produk)) {
                    echo "<option value='{$p['id']}'>{$p['nama']}</option>";
                  }
                  ?>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Jenis Kulit</label>
                <select name="jenis_kulit" class="form-control" required>
                  <option value="">Pilih Jenis Kulit</option>
                  <option>Kulit Berminyak</option>
                  <option>Kulit Sensitif</option>
                  <option>Kulit Kombinasi</option>
                  <option>Kulit Kering</option>
                  <option>Kulit Berjerawat</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Masalah Kulit</label>
                <select name="masalah_kulit" class="form-control" required>
                  <option value="">Pilih Masalah</option>
                  <option>Jerawat</option>
                  <option>Kusam</option>
                  <option>Kemerahan</option>
                  <option>Flek/Noda</option>
                  <option>Tanpa Masalah Khusus</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Efek</label>
                <select name="efek" class="form-control">
                  <option value="">Pilih Efek</option>
                  <option>Mencerahkan</option>
                  <option>Melembapkan</option>
                  <option>Mengontrol Minyak</option>
                  <option>Eksfoliasi</option>
                </select>
              </div>
              <div class="form-group col-md-6">
                <label>Efek</label>
                <select name="bebas_alkohol" class="form-control">
                  <option value="">Pilih Efek</option>
                  <option>Ya</option>
                  <option>Tidak</option>
                </select>
              </div>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan Rule</button>
          </form>
        </div>
      </div>

      <!-- Tabel Data Rule -->
      <div class="card">
        <div class="card-header">Daftar Rules</div>
        <div class="card-body table-responsive">
          <table class="table table-bordered table-hover">
            <thead>
              <tr>
                <th>No</th>
                <th>Jenis Kulit</th>
                <th>Masalah Kulit</th>
                <th>Efek</th>
                <th>Bebas Alkohol</th>
                <th>Produk</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php
              $no = 1;
              $sql = mysqli_query($connect, "SELECT r.*, p.nama FROM tb_rule r JOIN tb_produk p ON r.produk_id = p.id ORDER BY r.id DESC");
              if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_array($sql)) {
              ?>
              <tr>
                <td><?= $no++; ?></td>
                <td><?= $row['jenis_kulit']; ?></td>
                <td><?= $row['masalah_kulit']; ?></td>
                <td><?= $row['efek'] ?: '-'; ?></td>
                <td><?= $row['bebas_alkohol'] ?: '-'; ?></td>
                <td><?= $row['nama']; ?></td>
                <td>
                  <button type="button" class="btn btn-sm btn-secondary btn-edit-rule"
                    data-id="<?= $row['id']; ?>"
                    data-produk_id="<?= $row['produk_id']; ?>"
                    data-jenis_kulit="<?= htmlspecialchars($row['jenis_kulit'], ENT_QUOTES); ?>"
                    data-masalah_kulit="<?= htmlspecialchars($row['masalah_kulit'], ENT_QUOTES); ?>"
                    data-efek="<?= htmlspecialchars($row['efek'], ENT_QUOTES); ?>"
                    data-bebas_alkohol="<?= htmlspecialchars($row['bebas_alkohol'], ENT_QUOTES); ?>"
                  >Edit</button>

                  <form method="post" action="actions.php" style="display:inline">
                    <input type="hidden" name="action" value="delete_rule">
                    <input type="hidden" name="id" value="<?= $row['id']; ?>">
                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Hapus rule ini?')">Hapus</button>
                  </form>
                </td>
              </tr>
              <?php
                }
              } else {
                echo '<tr><td colspan="8" class="text-center">Belum ada data rule</td></tr>';
              }
              ?>
            </tbody>
          </table>
        </div>
      </div>
    </main>
  </div>
</div>

<!-- Edit Rule Modal -->
<div class="modal fade" id="editRuleModal" tabindex="-1" role="dialog" aria-labelledby="editRuleLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="actions.php">
        <div class="modal-header">
          <h5 class="modal-title" id="editRuleLabel">Edit Rule</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <input type="hidden" name="action" value="edit_rule">
          <input type="hidden" name="id" value="" />
          <div class="form-group">
            <label>Pilih Produk</label>
            <select name="produk_id" class="form-control" required>
              <option value="">Pilih Produk</option>
              <?php
              $produkOpt = mysqli_query($connect, "SELECT id, nama FROM tb_produk ORDER BY nama ASC");
              while ($po = mysqli_fetch_array($produkOpt)) {
                echo "<option value='{$po['id']}'>{$po['nama']}</option>";
              }
              ?>
            </select>
          </div>
          <div class="form-group">
            <label>Jenis Kulit</label>
            <select name="jenis_kulit" class="form-control" required>
              <option value="">Pilih Jenis Kulit</option>
              <option>Kulit Berminyak</option>
              <option>Kulit Sensitif</option>
              <option>Kulit Kombinasi</option>
              <option>Kulit Kering</option>
              <option>Kulit Berjerawat</option>
            </select>
          </div>
          <div class="form-group">
            <label>Masalah Kulit</label>
            <select name="masalah_kulit" class="form-control" required>
              <option value="">Pilih Masalah</option>
              <option>Jerawat</option>
              <option>Kusam</option>
              <option>Kemerahan</option>
              <option>Flek/Noda</option>
              <option>Tanpa Masalah Khusus</option>
            </select>
          </div>
          <div class="form-group">
            <label>Efek</label>
            <select name="efek" class="form-control">
              <option value="">Pilih Efek</option>
              <option>Mencerahkan</option>
              <option>Melembapkan</option>
              <option>Mengontrol Minyak</option>
              <option>Eksfoliasi</option>
            </select>
          </div>
          <div class="form-group">
            <label>Bebas Alkohol</label>
            <select name="bebas_alkohol" class="form-control">
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
    document.querySelectorAll('.btn-edit-rule').forEach(function(btn){
      btn.addEventListener('click', function(){
        var id = this.getAttribute('data-id');
        var produk_id = this.getAttribute('data-produk_id');
        var jenis_kulit = this.getAttribute('data-jenis_kulit');
        var masalah_kulit = this.getAttribute('data-masalah_kulit');
        var efek = this.getAttribute('data-efek');
        var bebas_alkohol = this.getAttribute('data-bebas_alkohol');

        var modal = document.getElementById('editRuleModal');
        modal.querySelector('input[name="id"]').value = id;
        modal.querySelector('select[name="produk_id"]').value = produk_id;
        modal.querySelector('select[name="jenis_kulit"]').value = jenis_kulit;
        modal.querySelector('select[name="masalah_kulit"]').value = masalah_kulit;
        modal.querySelector('select[name="efek"]').value = efek;
        modal.querySelector('select[name="bebas_alkohol"]').value = bebas_alkohol;

        $('#editRuleModal').modal('show');
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
  $jenis_kulit = $_POST['jenis_kulit'];
  $masalah_kulit = $_POST['masalah_kulit'];
  $efek = $_POST['efek'];
  $bebas_alkohol = isset($_POST['bebas_alkohol']) ? 'Ya' : 'Tidak';
  $produk_id = $_POST['produk_id'];

  $simpan = mysqli_query($connect, "INSERT INTO tb_rule (
    jenis_kulit, masalah_kulit, efek,
    bebas_alkohol, produk_id
  ) VALUES (
    '$jenis_kulit', '$masalah_kulit', '$efek',
    '$bebas_alkohol', '$produk_id'
  )");

  if ($simpan) {
    echo "<script>alert('Rule berhasil disimpan!'); window.location='pakar-rule.php';</script>";
  } else {
    echo "<script>alert('Gagal menyimpan rule');</script>";
  }
}
?>
