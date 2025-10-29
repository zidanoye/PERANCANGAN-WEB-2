<?php
require 'koneksi.php';
$judul = mysqli_real_escape_string($koneksi, $_POST['judul']);
$deskripsi = mysqli_real_escape_string($koneksi, $_POST['deskripsi']);
$pilihan = mysqli_real_escape_string($koneksi, $_POST['pilihan']);
$sql = "INSERT INTO form_custom (judul, deskripsi, pilihan) VALUES ('$judul','$deskripsi','$pilihan')";
if (mysqli_query($koneksi, $sql)) {
    echo "<h3>Form berhasil disimpan.</h3>";
} else {
    echo "Error: ".mysqli_error($koneksi);
}
$res = mysqli_query($koneksi, "SELECT * FROM form_custom ORDER BY created_at DESC");
echo "<h3>Isi Form Custom</h3><table border='1' cellpadding='6'><tr><th>ID</th><th>Judul</th><th>Pilihan</th><th>Waktu</th></tr>";
while($r = mysqli_fetch_assoc($res)){
    echo "<tr><td>{$r['id']}</td><td>{$r['judul']}</td><td>{$r['pilihan']}</td><td>{$r['created_at']}</td></tr>";
}
echo "</table>";
?>
