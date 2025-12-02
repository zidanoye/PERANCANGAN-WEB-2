<?php
include 'koneksi.php';
if (!isset($_GET['del'])) {
    header('Location: tampil_foto.php');
    exit;
}
$del = intval($_GET['del']);
$stmt = $koneksi->prepare("SELECT foto FROM namasiswa WHERE id = ?");
$stmt->bind_param('i', $del);
$stmt->execute();
$stmt->bind_result($fotoPath);
if (!$stmt->fetch()) {
    $stmt->close();
    echo "Data tidak ditemukan. <a href='tampil_foto.php'>Kembali</a>";
    exit;
}
$stmt->close();
$fullPath = __DIR__ . '/' . $fotoPath;
if (is_file($fullPath)) {
    @unlink($fullPath);
}
$stmt2 = $koneksi->prepare("DELETE FROM namasiswa WHERE id = ?");
$stmt2->bind_param('i', $del);
if ($stmt2->execute()) {
    echo "Gambar berhasil dihapus.<br><a href='tampil_foto.php'>Kembali</a>";
} else {
    echo "Gagal menghapus: " . $stmt2->error;
}
$stmt2->close();
$koneksi->close();
?>
