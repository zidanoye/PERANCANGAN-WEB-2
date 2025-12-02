<?php
session_start();
if (!isset($_SESSION['username'])) {
  header("Location: login.php");
  exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Halaman Utama</title>
</head>
<body style="text-align:center;">
<h2>Selamat Datang, <?php echo $_SESSION['username']; ?>!</h2>
<p>Jenis kelamin Anda: <?php echo $_SESSION['gender']; ?></p>
<p>Anda berhasil login menggunakan session.</p>
<a href="logout.php">Logout</a>
</body>
</html>
