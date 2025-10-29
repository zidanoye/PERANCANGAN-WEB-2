<?php
require 'koneksi.php';
$nama = mysqli_real_escape_string($koneksi, $_POST['nama']);
$nisn = mysqli_real_escape_string($koneksi, $_POST['nisn']);
$alamat = mysqli_real_escape_string($koneksi, $_POST['alamat']);
$tanggal_lahir = $_POST['tanggal_lahir'] ?? NULL;
$sekolah_asal = mysqli_real_escape_string($koneksi, $_POST['sekolah_asal']);
$jurusan = mysqli_real_escape_string($koneksi, $_POST['jurusan']);
$sql = "INSERT INTO pendaftaran_sekolah (nama, nisn, alamat, tanggal_lahir, sekolah_asal, jurusan)
        VALUES ('$nama','$nisn','$alamat', ".($tanggal_lahir? "'$tanggal_lahir'":"NULL").", '$sekolah_asal','$jurusan')";
if (mysqli_query($koneksi, $sql)) {
    echo "<h3>Data berhasil disimpan.</h3>";
} else {
    echo "Error: " . mysqli_error($koneksi);
}
$result = mysqli_query($koneksi, "SELECT * FROM pendaftaran_sekolah ORDER BY created_at DESC");
echo "<h3>Daftar Pendaftar</h3>";
echo "<table border='1' cellpadding='6'><tr><th>ID</th><th>Nama</th><th>NISN</th><th>Jurusan</th><th>Sekolah Asal</th><th>Tgl Lahir</th><th>Waktu</th></tr>";
while($row = mysqli_fetch_assoc($result)) {
    echo "<tr>
            <td>{$row['id']}</td>
            <td>{$row['nama']}</td>
            <td>{$row['nisn']}</td>
            <td>{$row['jurusan']}</td>
            <td>{$row['sekolah_asal']}</td>
            <td>{$row['tanggal_lahir']}</td>
            <td>{$row['created_at']}</td>
          </tr>";
}
echo "</table>";
?>
