<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "foto";
$koneksi = new mysqli($host, $user, $pass, $db);
if ($koneksi->connect_errno) {
    die("Koneksi gagal: (" . $koneksi->connect_errno . ") " . $koneksi->connect_error);
}
$koneksi->set_charset("utf8mb4");
?>
