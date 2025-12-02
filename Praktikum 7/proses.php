<?php
include 'koneksi.php';
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: input_foto.php');
    exit;
}
$nama = trim($_POST['nama'] ?? '');
if ($nama === '') {
    echo "Nama masih kosong. <a href='input_foto.php'>Kembali</a>";
    exit;
}
if (!isset($_FILES['foto']) || $_FILES['foto']['error'] !== UPLOAD_ERR_OK) {
    echo "File tidak ditemukan atau upload gagal. <a href='input_foto.php'>Kembali</a>";
    exit;
}
$file = $_FILES['foto'];
$maxSize = 1 * 1024 * 1024; 
$allowedExt = ['jpg','jpeg','png','gif'];
$uploadDir = __DIR__ . '/gambar/';
if ($file['size'] > $maxSize) {
    echo "Ukuran file melebihi 1MB. <a href='input_foto.php'>Kembali</a>";
    exit;
}
$ext = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
if (!in_array($ext, $allowedExt)) {
    echo "Jenis file tidak diperbolehkan. Hanya jpg,jpeg,png,gif. <a href='input_foto.php'>Kembali</a>";
    exit;
}
$imgInfo = @getimagesize($file['tmp_name']);
if ($imgInfo === false) {
    echo "File bukan gambar yang valid. <a href='input_foto.php'>Kembali</a>";
    exit;
}
$uniqueName = bin2hex(random_bytes(8)) . "_" . time() . "." . $ext;
$destPath = $uploadDir . $uniqueName;
if (!is_dir($uploadDir)) {
    if (!mkdir($uploadDir, 0755, true)) {
        echo "Gagal membuat folder upload. Hubungi admin.";
        exit;
    }
}
if (!is_writable($uploadDir)) {
    echo "Folder upload tidak writable. Set permission 0755/0777 jika perlu.";
    exit;
}
if (!move_uploaded_file($file['tmp_name'], $destPath)) {
    echo "Gagal menyimpan file ke server. <a href='input_foto.php'>Kembali</a>";
    exit;
}
$stmt = $koneksi->prepare("INSERT INTO namasiswa (nama, foto) VALUES (?, ?)");
if (!$stmt) {
    @unlink($destPath);
    echo "Gagal menyiapkan query: " . $koneksi->error;
    exit;
}
$relativePath = 'gambar/' . $uniqueName; 
$stmt->bind_param('ss', $nama, $relativePath);
if ($stmt->execute()) {
    echo "Berhasil disimpan.<br>";
    echo "Nama: " . htmlspecialchars($nama, ENT_QUOTES, 'UTF-8') . "<br>";
    echo "<img src='" . htmlspecialchars($relativePath, ENT_QUOTES) . "' height='200' alt='foto'><br>";
    echo "<a href='tampil_foto.php'>Lihat Halaman Berikutnya</a>";
} else {
    @unlink($destPath);
    echo "Gagal menyimpan ke database: " . $stmt->error;
}
$stmt->close();
$koneksi->close();
?>
