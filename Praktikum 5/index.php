<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>Akses & Manipulasi Data</title>
  <style>
    body {
      display:flex;flex-direction:column;align-items:center;
      justify-content:center;min-height:100vh;text-align:center;
      background:#fafafa;font-family:Arial;
    }
    a { text-decoration:none; background:#007BFF; color:#fff;
        padding:8px 12px; border-radius:5px; }
    a:hover { background:#0056b3; }
  </style>
</head>
<body>
  <?php
  ini_set('display_errors',1);
  require_once "koneksi.php";
  require_once "data_handler.php";
  define('MHS','mahasiswa');
  data_handler('?m=data');
  ?>
</body>
</html>
