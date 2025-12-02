<!doctype html>
<html lang="id">
<head>
  <meta charset="utf-8">
  <title>Upload Gambar</title>
</head>
<body>
  <h2>SIMPAN & TAMPIL GAMBAR</h2>
  <form method="post" action="proses.php" enctype="multipart/form-data">
    <label>Nama<br>
      <input type="text" name="nama" id="nama" placeholder="masukan nama" required>
    </label>
    <br><br>
    <label>Pilih Foto (jpg, jpeg, png, gif) - max 1MB<br>
      <input type="file" name="foto" id="foto" accept=".jpg,.jpeg,.png,.gif" required>
    </label>
    <br><br>
    <input type="submit" name="kirim" value="SIMPAN">
  </form>
  <p><a href="tampil_foto.php">Lihat data foto</a></p>
</body>
</html>
