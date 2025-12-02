<?php
require_once "koneksi.php";
$sql = "SELECT * FROM mahasiswa";
$res = mysqli_query($koneksi, $sql);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Data Mahasiswa</title>
  <style>
    body {
      display: flex;
      flex-direction: column;
      align-items: center;
      justify-content: center;
      min-height: 100vh;
      font-family: Arial;
      text-align: center;
      background: #f5f5f5;
    }
    table {
      border-collapse: collapse;
      margin-top: 20px;
      background: #fff;
      box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }
    th, td {
      padding: 8px 14px;
      border: 1px solid #ccc;
    }
    th { background: #eee; }
  </style>
</head>
<body>
  <h2>Data Mahasiswa</h2>
  <table>
    <tr><th>#</th><th>NIM</th><th>Nama</th><th>Alamat</th></tr>
    <?php
    $i=1;
    if (mysqli_num_rows($res) > 0) {
      while($row = mysqli_fetch_assoc($res)){
        echo "<tr>
          <td>{$i}</td>
          <td>{$row['nim']}</td>
          <td>{$row['nama']}</td>
          <td>{$row['alamat']}</td>
        </tr>";
        $i++;
      }
    } else {
      echo "<tr><td colspan='4'>Data tidak ditemukan</td></tr>";
    }
    ?>
  </table>
</body>
</html>
