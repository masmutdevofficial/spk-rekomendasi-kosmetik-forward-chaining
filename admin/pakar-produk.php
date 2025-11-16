<?php
include __DIR__ . '/../auth/check.php';
include __DIR__ . '/../config/koneksi.php';
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Data Produk Sabun Muka</title>
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
      <h4 class="mt-4 mb-4">Data Produk Sabun Muka</h4>

      <!-- Form Tambah Produk -->
        <div class="card mb-4">
        <div class="card-header">Tambah Produk</div>
        <div class="card-body">
            <form method="POST" action="" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group col-md-6">
                <label>Nama Produk</label>
                <input type="text" name="nama" class="form-control" placeholder="Contoh: Facial Wash Brightening" required>
                </div>
                <div class="form-group col-md-6">
                <label>Merek (opsional)</label>
                <input type="text" name="merek" class="form-control" placeholder="Contoh: Wardah, Garnier, dll">
                </div>
                <div class="form-group col-md-6">
                <label>Perusahaan (opsional)</label>
                <input type="text" name="perusahaan" class="form-control" placeholder="Contoh: PT XYZ Indonesia">
                </div>
                <div class="form-group col-md-6">
                <label>Harga (opsional)</label>
                <input type="number" name="harga" class="form-control" step="0.01" placeholder="Contoh: 25000">
                </div>
                <div class="form-group col-md-12">
                <label>Kandungan (opsional)</label>
                <textarea name="kandungan" class="form-control" rows="2" placeholder="Contoh: Niacinamide, Salicylic Acid, dll"></textarea>
                </div>
                <div class="form-group col-md-12">
                <label>Deskripsi (opsional)</label>
                <textarea name="deskripsi" class="form-control" rows="2" placeholder="Contoh: Sabun wajah untuk kulit berminyak, membuat kulit segar dan cerah."></textarea>
                </div>
                <div class="form-group col-md-12">
                <label>Cara Penggunaan (opsional)</label>
                <textarea name="cara_penggunaan" class="form-control" rows="2" placeholder="Contoh: Gunakan pagi dan malam hari, pijat lembut lalu bilas."></textarea>
                </div>
                <div class="form-group col-md-12">
                <label>Gambar Produk (opsional)</label>
                <input type="file" name="gambar" class="form-control-file">
                </div>
            </div>
            <button type="submit" name="simpan" class="btn btn-primary">Simpan</button>
            </form>
        </div>
        </div>


        <!-- Tabel Data Produk -->
        <div class="card">
        <div class="card-header">Daftar Produk</div>
        <div class="card-body table-responsive">
            <table class="table table-bordered table-hover">
            <thead>
                <tr>
                <th>No</th>
                <th>Gambar</th>
                <th>Nama</th>
                <th>Merek</th>
                <th>Perusahaan</th>
                <th>Harga</th>
                <th>Deskripsi</th>
                <th>Cara Penggunaan</th>
                <th>Dibuat Pada</th>
                <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                $sql = mysqli_query($connect, "SELECT * FROM tb_produk ORDER BY id DESC");
                if (mysqli_num_rows($sql) > 0) {
                while ($row = mysqli_fetch_array($sql)) {
                ?>
                <tr>
                <td><?= $no++; ?></td>
                <td>
                    <?php if ($row['gambar']) { ?>
                    <img src="../uploads/<?= $row['gambar']; ?>" width="60">
                    <?php } else { echo '-'; } ?>
                </td>
                <td><?= $row['nama']; ?></td>
                <td><?= $row['merek'] ?: '-'; ?></td>
                <td><?= $row['perusahaan'] ?: '-'; ?></td>
                <td><?= $row['harga'] ? 'Rp ' . number_format($row['harga'], 2, ',', '.') : '-'; ?></td>
                <td><?= $row['deskripsi'] ?: '-'; ?></td>
                <td><?= $row['cara_penggunaan'] ?: '-'; ?></td>
                <td><?= date('d-m-Y H:i', strtotime($row['created_at'])); ?></td>
                <td>
                    <button type="button" class="btn btn-sm btn-warning btn-edit" 
                      data-id="<?= $row['id']; ?>" 
                      data-nama="<?= htmlspecialchars($row['nama'], ENT_QUOTES); ?>"
                      data-merek="<?= htmlspecialchars($row['merek'], ENT_QUOTES); ?>"
                      data-perusahaan="<?= htmlspecialchars($row['perusahaan'], ENT_QUOTES); ?>"
                      data-harga="<?= $row['harga']; ?>"
                      data-kandungan="<?= htmlspecialchars($row['kandungan'], ENT_QUOTES); ?>"
                      data-deskripsi="<?= htmlspecialchars($row['deskripsi'], ENT_QUOTES); ?>"
                      data-cara="<?= htmlspecialchars($row['cara_penggunaan'], ENT_QUOTES); ?>"
                    >Edit</button>
                    <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="<?= $row['id']; ?>">Hapus</button>
                </td>
                </tr>
                <?php
                }
                } else {
                echo '<tr><td colspan="10" class="text-center">Belum ada data</td></tr>';
                }
                ?>
            </tbody>
            </table>
        </div>
        </div>

    </main>
  </div>
</div>

<!-- Modals -->
<!-- Delete modal -->
<div class="modal" tabindex="-1" role="dialog" id="deleteModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="actions.php">
      <div class="modal-header">
        <h5 class="modal-title">Hapus Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Apakah anda yakin ingin menghapus produk ini?</p>
        <input type="hidden" name="action" value="delete_produk">
        <input type="hidden" name="id" id="delete-id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Hapus</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>

<!-- Edit modal -->
<div class="modal" tabindex="-1" role="dialog" id="editModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <form method="post" action="actions.php">
      <div class="modal-header">
        <h5 class="modal-title">Edit Produk</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <input type="hidden" name="action" value="edit_produk">
        <input type="hidden" name="id" id="edit-id" value="">
        <div class="form-group">
          <label>Nama</label>
          <input type="text" name="nama" id="edit-nama" class="form-control">
        </div>
        <div class="form-group">
          <label>Merek</label>
          <input type="text" name="merek" id="edit-merek" class="form-control">
        </div>
        <div class="form-group">
          <label>Perusahaan</label>
          <input type="text" name="perusahaan" id="edit-perusahaan" class="form-control">
        </div>
        <div class="form-group">
          <label>Harga</label>
          <input type="number" name="harga" id="edit-harga" class="form-control" step="0.01">
        </div>
        <div class="form-group">
          <label>Kandungan</label>
          <textarea name="kandungan" id="edit-kandungan" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Deskripsi</label>
          <textarea name="deskripsi" id="edit-deskripsi" class="form-control"></textarea>
        </div>
        <div class="form-group">
          <label>Cara Penggunaan</label>
          <textarea name="cara_penggunaan" id="edit-cara" class="form-control"></textarea>
        </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Simpan</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
      </div>
      </form>
    </div>
  </div>
</div>

<script src="https://unpkg.com/feather-icons"></script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://getbootstrap.com/docs/4.1/dist/js/bootstrap.min.js"></script>
<script>feather.replace()</script>
<script>
$(document).ready(function(){
  $('.btn-delete').on('click', function(){
    var id = $(this).data('id');
    $('#delete-id').val(id);
    $('#deleteModal').modal('show');
  });

  $('.btn-edit').on('click', function(){
    $('#edit-id').val($(this).data('id'));
    $('#edit-nama').val($(this).data('nama'));
    $('#edit-merek').val($(this).data('merek'));
    $('#edit-perusahaan').val($(this).data('perusahaan'));
    $('#edit-harga').val($(this).data('harga'));
    $('#edit-kandungan').val($(this).data('kandungan'));
    $('#edit-deskripsi').val($(this).data('deskripsi'));
    $('#edit-cara').val($(this).data('cara'));
    $('#editModal').modal('show');
  });
});
</script>
</body>
</html>

<?php
if (isset($_POST['simpan'])) {
  // kept for compatibility if direct form used
}
?>
