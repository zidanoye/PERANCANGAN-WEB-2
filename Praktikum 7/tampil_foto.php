<?php
include 'koneksi.php';
$perintah = "SELECT * FROM namasiswa ORDER BY id DESC";
$result = $koneksi->query($perintah);
if (!$result) {
    die("Query error: " . $koneksi->error);
}
?>
<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Halaman Tampil Foto</title>
</head>
<body>
  <h2>MENAMPILKAN FOTO</h2>
  <p><a href="input_foto.php">TAMBAH DATA</a></p>
  <table border="1" width="600" cellpadding="6">
    <tr>
      <th>NO</th>
      <th>NAMA</th>
      <th>FOTO</th>
      <th>ACTION</th>
    </tr>
    <?php
    $no = 1;
    while ($data = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $no++ . "</td>";
        echo "<td>" . htmlspecialchars($data['nama'], ENT_QUOTES, 'UTF-8') . "</td>";
        echo "<td align='center'><img src='" . htmlspecialchars($data['foto'], ENT_QUOTES) . "' width='80' height='100' alt='foto'></td>";
        echo "<td><a href='delete.php?del=" . urlencode($data['id']) . "' onclick=\"return confirm('Yakin ingin dihapus?');\">DELETE</a></td>";
        echo "</tr>";
    }
    ?>
  </table>
</body>
</html>
<?php
$result->free();
$koneksi->close();
?>
