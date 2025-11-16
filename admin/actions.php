<?php
// Generic admin actions handler for delete/edit via POST
include __DIR__ . '/config_check.php';
include __DIR__ . '/../config/koneksi.php';

session_start();
if (!isset($_SESSION['admin'])) {
    header('Location: ../auth/login.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: pakar-home.php');
    exit;
}

$action = $_POST['action'] ?? '';

if ($action === 'delete_produk') {
    $id = intval($_POST['id']);
    // get gambar
    $q = mysqli_query($connect, "SELECT gambar FROM tb_produk WHERE id=$id");
    if ($r = mysqli_fetch_assoc($q)) {
        if (!empty($r['gambar'])) {
            $f = __DIR__ . '/../uploads/' . $r['gambar'];
            if (file_exists($f)) @unlink($f);
        }
    }
    mysqli_query($connect, "DELETE FROM tb_produk WHERE id=$id");
    header('Location: pakar-produk.php');
    exit;
}

if ($action === 'edit_produk') {
    $id = intval($_POST['id']);
    $nama = mysqli_real_escape_string($connect, $_POST['nama']);
    $merek = mysqli_real_escape_string($connect, $_POST['merek']);
    $perusahaan = mysqli_real_escape_string($connect, $_POST['perusahaan']);
    $harga = floatval($_POST['harga']);
    $kandungan = mysqli_real_escape_string($connect, $_POST['kandungan']);
    $deskripsi = mysqli_real_escape_string($connect, $_POST['deskripsi']);
    $cara = mysqli_real_escape_string($connect, $_POST['cara_penggunaan']);

    $sql = "UPDATE tb_produk SET nama='$nama', merek='$merek', perusahaan='$perusahaan', harga='$harga', kandungan='$kandungan', deskripsi='$deskripsi', cara_penggunaan='$cara' WHERE id=$id";
    mysqli_query($connect, $sql);
    header('Location: pakar-produk.php');
    exit;
}

if ($action === 'delete_fakta') {
    $id = intval($_POST['id']);
    mysqli_query($connect, "DELETE FROM tb_fakta WHERE id=$id");
    header('Location: pakar-fakta.php');
    exit;
}

if ($action === 'delete_rule') {
    $id = intval($_POST['id']);
    mysqli_query($connect, "DELETE FROM tb_rule WHERE id=$id");
    header('Location: pakar-rule.php');
    exit;
}

if ($action === 'edit_fakta') {
    $id = intval($_POST['id']);
    $kode = mysqli_real_escape_string($connect, $_POST['kode']);
    $pertanyaan = mysqli_real_escape_string($connect, $_POST['pertanyaan']);
    $kategori = mysqli_real_escape_string($connect, $_POST['kategori']);
    $aktif = isset($_POST['aktif']) ? mysqli_real_escape_string($connect, $_POST['aktif']) : 'Tidak';

    $sql = "UPDATE tb_fakta SET kode='$kode', pertanyaan='$pertanyaan', kategori='$kategori', aktif='$aktif' WHERE id=$id";
    mysqli_query($connect, $sql);
    header('Location: pakar-fakta.php');
    exit;
}

if ($action === 'edit_rule') {
    $id = intval($_POST['id']);
    $produk_id = intval($_POST['produk_id']);
    $jenis_kulit = mysqli_real_escape_string($connect, $_POST['jenis_kulit']);
    $masalah_kulit = mysqli_real_escape_string($connect, $_POST['masalah_kulit']);
    $efek = mysqli_real_escape_string($connect, $_POST['efek']);
    $bebas_alkohol = isset($_POST['bebas_alkohol']) ? mysqli_real_escape_string($connect, $_POST['bebas_alkohol']) : 'Tidak';

    $sql = "UPDATE tb_rule SET produk_id=$produk_id, jenis_kulit='$jenis_kulit', masalah_kulit='$masalah_kulit', efek='$efek', bebas_alkohol='$bebas_alkohol' WHERE id=$id";
    mysqli_query($connect, $sql);
    header('Location: pakar-rule.php');
    exit;
}

// unknown action
header('Location: pakar-home.php');
exit;
