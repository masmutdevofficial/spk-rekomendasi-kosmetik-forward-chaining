<?php
session_start();
if (isset($_SESSION['admin'])) {
    header('Location: ../admin/pakar-home.php');
    exit;
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Login Pakar</title>
  <link rel="icon" href="assets/image/icon.png">
  <link rel="stylesheet" href="https://getbootstrap.com/docs/4.1/dist/css/bootstrap.min.css">
  <style>
    body { height:100vh; display:flex; align-items:center; justify-content:center; background:#f7f9fc; }
    .form-signin { width:100%; max-width:420px; padding:15px; background:white; border-radius:8px; box-shadow:0 6px 20px rgba(0,0,0,0.08); }
    .form-signin img { display:block; margin:0 auto 12px; }
  </style>
</head>
<body>
  <form class="form-signin" action="login_process.php" method="POST">
    <img src="assets/image/icon.png" alt="logo" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal text-center">Please sign in</h1>
    <label for="inputUsername" class="sr-only">Username</label>
    <input type="text" name="username" id="inputEmail" class="form-control mb-2" placeholder="Username" required autofocus>
    <label for="inputPassword" class="sr-only">Password</label>
    <input type="password" name="password" id="inputPassword" class="form-control mb-3" placeholder="Password" required>
    <button class="btn btn-lg btn-info btn-block" type="submit">Sign in</button>
    <p class="mt-3 mb-0 text-center text-muted">&copy; 2025</p>
  </form>
</body>
</html>
