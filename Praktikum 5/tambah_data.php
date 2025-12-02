<?php
require_once "koneksi.php";

if (isset($_POST['nim']) && isset($_POST['nama'])) {
  $nim = $_POST['nim'];
  $nama = $_POST['nama'];
  $alamat = $_POST['alamat'];

  $sql = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$alamat')";
  if (mysqli_query($koneksi, $sql)) {
    echo "<script>alert('Data berhasil ditambahkan');</script>";
  } else {
    echo "Gagal menambah data: " . mysqli_error($koneksi);
  }
}
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tambah Data Mahasiswa</title>
  <style>
    body {
      display: flex; flex-direction: column; align-items: center;
      justify-content: center; min-height: 100vh; font-family: Arial;
      background: #f8f8f8;
    }
    form { background: #fff; padding: 20px; border-radius: 10px;
           box-shadow: 0 2px 6px rgba(0,0,0,0.1); }
    table td { padding: 8px; }
    h2 { text-align: center; }
  </style>
</head>
<body>
  <h2>Tambah Data Mahasiswa</h2>
  <form method="post">
    <table>
      <tr><td>NIM</td><td><input type="text" name="nim" required></td></tr>
      <tr><td>Nama</td><td><input type="text" name="nama" required></td></tr>
      <tr><td>Alamat</td><td><input type="text" name="alamat"></td></tr>
      <tr><td></td><td><input type="submit" value="Simpan"></td></tr>
    </table>
  </form>
  <br>
  <?php include "seleksi.php"; ?>
</body>
</html>
