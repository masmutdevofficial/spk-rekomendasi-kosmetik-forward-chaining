<?php
session_start();
include __DIR__ . '/../config/koneksi.php';

if (empty($_POST['username']) || empty($_POST['password'])) {
    header('Location: login.php');
    exit;
}

$username = mysqli_real_escape_string($connect, $_POST['username']);
$password = $_POST['password'];
$pass = stripslashes($password);
$pass = mysqli_real_escape_string($connect, $pass);
$pass = md5($pass);

$login = mysqli_query($connect, "SELECT * FROM tb_admin WHERE username = '$username' AND password='$pass'");
$row = mysqli_fetch_array($login);

if ($row && $row['username'] == $username && $row['password'] == $pass) {
    $_SESSION['admin'] = $row['username'];
    header('Location: ../admin/pakar-home.php');
    exit;
} else {
    echo "<script>alert('Maaf, Pastikan Username dan Password anda benar!'); window.location=('login.php');</script>";
}
?>
