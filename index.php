<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Sistem Pakar - Rekomendasi Produk</title>
  <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css">
  <style>
    body {
      background: #f7f9fc;
    }
    .jumbotron {
      background: linear-gradient(to right, #6dd5ed, #2193b0);
      color: white;
      padding: 4rem 2rem;
      border-radius: 1rem;
      box-shadow: 0 5px 15px rgba(0,0,0,0.1);
    }
    .btn-mulai {
      font-weight: bold;
      padding: 12px 30px;
      font-size: 1.1rem;
    }
  </style>
</head>
<?php session_start(); ?>
<body>

<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <a class="navbar-brand" href="#">Sistem Pakar</a>
  <div class="ml-auto">
    <?php if (!empty($_SESSION['admin'])): ?>
      <a href="admin/pakar-home.php" class="btn btn-outline-light">Dashboard</a>
    <?php else: ?>
      <a href="auth/login.php" class="btn btn-outline-light">Login</a>
    <?php endif; ?>
  </div>
</nav>

<!-- Jumbotron -->
<div class="container mt-5">
  <div class="jumbotron text-center">
    <h1 class="display-4">Selamat Datang di Sistem Pakar</h1>
    <p class="lead">Dapatkan rekomendasi produk sabun muka berdasarkan jenis dan masalah kulit Anda.</p>
    <hr class="my-4" style="border-color: rgba(255,255,255,0.4)">
    <a class="btn btn-light btn-mulai" href="forward-simulasi.php">Mulai Sekarang</a>
  </div>
</div>

</body>
</html>
