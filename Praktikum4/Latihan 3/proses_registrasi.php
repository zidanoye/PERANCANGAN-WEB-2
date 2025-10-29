<?php
require 'koneksi.php';
$username = mysqli_real_escape_string($koneksi, $_POST['username']);
$email = mysqli_real_escape_string($koneksi, $_POST['email']);
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$fullname = mysqli_real_escape_string($koneksi, $_POST['fullname']);
$sql = "INSERT INTO users_registrasi (username, email, password, fullname) VALUES ('$username','$email','$password','$fullname')";
if (mysqli_query($koneksi, $sql)) {
    echo "<h3>Registrasi berhasil.</h3>";
} else {
    echo "Error: ".mysqli_error($koneksi);
}
$res = mysqli_query($koneksi, "SELECT id, username, email, fullname, created_at FROM users_registrasi ORDER BY created_at DESC");
echo "<h3>Daftar User</h3><table border='1' cellpadding='6'><tr><th>ID</th><th>Username</th><th>Email</th><th>Fullname</th><th>Waktu</th></tr>";
while($u = mysqli_fetch_assoc($res)) {
    echo "<tr><td>{$u['id']}</td><td>{$u['username']}</td><td>{$u['email']}</td><td>{$u['fullname']}</td><td>{$u['created_at']}</td></tr>";
}
echo "</table>";
?>
