<?php
session_start();
require "koneksi.php";
if (isset($_POST['daftar'])) {
  $username = $_POST['username'];
  $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
  $gender   = $_POST['gender'];
  $cek = mysqli_query($koneksi, "SELECT * FROM login WHERE username='$username'");
  if (mysqli_num_rows($cek) > 0) {
    echo "<script>alert('Username sudah terdaftar!');</script>";
  } else {
    mysqli_query($koneksi, "INSERT INTO login VALUES('$username', '$password', '$gender')");
    echo "<script>alert('User berhasil terdaftar!');window.location='login.php';</script>";
  }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Form Pendaftaran</title>
</head>
<body style="text-align:center;">
<h2>Form Pendaftaran User</h2>
<form method="post">
  Username: <input type="text" name="username" required><br><br>
  Password: <input type="password" name="password" required><br><br>
  Jenis Kelamin:
  <select name="gender">
    <option value="Laki-laki">Laki-laki</option>
    <option value="Perempuan">Perempuan</option>
  </select><br><br>
  <input type="submit" name="daftar" value="Daftar">
</form>
<br>
<a href="login.php">Sudah punya akun? Login di sini</a>
</body>
</html>
