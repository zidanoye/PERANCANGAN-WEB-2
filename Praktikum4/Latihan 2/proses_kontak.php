<?php
require 'koneksi.php';
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$telepon = mysqli_real_escape_string($koneksi, $_POST['telepon']);
$pesan = mysqli_real_escape_string($koneksi, $_POST['pesan']);
$sql = "INSERT INTO kontak_siswa (nama, email, telepon, pesan) VALUES ('$nama','$email','$telepon','$pesan')";
if (mysqli_query($koneksi, $sql)) {
    echo "<h3>Pesan berhasil dikirim.</h3>";
} else {
    echo "Error: ".mysqli_error($koneksi);
}
$result = mysqli_query($koneksi, "SELECT * FROM kontak_siswa ORDER BY created_at DESC");
echo "<h3>Riwayat Kontak</h3><ul>";
while($r = mysqli_fetch_assoc($result)){
    echo "<li><strong>{$r['nama']}</strong> ({$r['email']}) - {$r['telepon']}<br>{$r['pesan']}<br><small>{$r['created_at']}</small></li><hr>";
}
echo "</ul>";
?>
