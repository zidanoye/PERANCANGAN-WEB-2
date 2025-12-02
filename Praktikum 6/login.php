<?php
session_start();
require "koneksi.php";
if (isset($_POST['login'])) {
  $username = $_POST['username'];
  $password = $_POST['password'];
  $query = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username'");
  $data = mysqli_fetch_assoc($query);
  if ($data && password_verify($password, $data['password'])) {
    $_SESSION['username'] = $data['username'];
    $_SESSION['gender'] = $data['gender'];
    header("Location: home.php");
    exit;
  } else {
    echo "<script>alert('Username atau Password salah!');</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Login User</title>
</head>
<body style="text-align:center;">
<h2>Form Login</h2>
<form method="post">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  <input type="submit" name="login" value="Login">
</form>
<br>
<a href="register.php">Belum punya akun? Daftar di sini</a>
</body>
</html>
