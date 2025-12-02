<?php
function data_handler($root) {
  if (isset($_GET['act']) && $_GET['act'] == 'add') { data_editor($root); return; }

  require "koneksi.php";
  $sql = "SELECT * FROM mahasiswa";
  $res = mysqli_query($koneksi, $sql);
  if (mysqli_num_rows($res) > 0) {
    if (isset($_GET['act']) && $_GET['act'] != '') {
      switch($_GET['act']) {
        case 'edit': if(isset($_GET['id'])) data_editor($root, $_GET['id']); else show_admin_data($root); break;
        case 'view': if(isset($_GET['id'])) data_detail($root, $_GET['id']); else show_admin_data($root); break;
        case 'del':
          if(isset($_GET['id'])) {
            $id = $_GET['id'];
            echo "<script>
              if(confirm('Yakin hapus data dengan NIM $id?')) {
                window.location='$root&act=delete&id=$id';
              } else { window.location='$root'; }
            </script>";
          }
          break;
        case 'delete':
          $id = $_GET['id'];
          mysqli_query($koneksi, "DELETE FROM mahasiswa WHERE nim='$id'");
          echo "<script>alert('Data $id berhasil dihapus');window.location='$root';</script>";
          break;
        default: show_admin_data($root);
      }
    } else {
      show_admin_data($root);
    }
  } else {
    echo "Data Tidak Ditemukan";
  }
}
function show_admin_data($root) {
  require "koneksi.php";
  $res = mysqli_query($koneksi, "SELECT * FROM mahasiswa");
  echo "<h2>Administrasi Data</h2>
  <div><a href='$root&act=add'>Tambah Data</a></div>
  <table border='1' cellpadding='6' cellspacing='0' style='margin-top:20px'>
  <tr><th>#</th><th>NIM</th><th>Nama</th><th>Alamat</th><th>Menu</th></tr>";
  $i=1;
  while($r=mysqli_fetch_assoc($res)){
    echo "<tr>
      <td>$i</td>
      <td><a href='$root&act=view&id={$r['nim']}'>{$r['nim']}</a></td>
      <td>{$r['nama']}</td>
      <td>{$r['alamat']}</td>
      <td>| <a href='$root&act=edit&id={$r['nim']}'>Edit</a> |
          <a href='$root&act=del&id={$r['nim']}'>Hapus</a> |</td>
    </tr>";
    $i++;
  }
  echo "</table>";
}

function data_detail($root, $id) {
  require "koneksi.php";
  $res = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$id'");
  $row = mysqli_fetch_assoc($res);
  echo "<h2>Detail Data</h2>
  <table border='1' cellpadding='6' cellspacing='0'>
  <tr><td>NIM</td><td>{$row['nim']}</td></tr>
  <tr><td>Nama</td><td>{$row['nama']}</td></tr>
  <tr><td>Alamat</td><td>{$row['alamat']}</td></tr>
  </table>
  <br><a href='$root'>Kembali</a>";
}

function data_editor($root, $id=0) {
  require "koneksi.php";
  $nim = ""; $nama = ""; $alamat = "";
  $edit_mode = false;

  if ($id) {
    $edit_mode = true;
    $res = mysqli_query($koneksi, "SELECT * FROM mahasiswa WHERE nim='$id'");
    $row = mysqli_fetch_assoc($res);
    $nim = $row['nim']; $nama = $row['nama']; $alamat = $row['alamat'];
  }

  if (isset($_POST['nim']) && $_POST['nama']) {
    $nim = $_POST['nim'];
    $nama = $_POST['nama'];
    $alamat = $_POST['alamat'];

    if (!$edit_mode) {
      $sql = "INSERT INTO mahasiswa VALUES ('$nim','$nama','$alamat')";
      mysqli_query($koneksi, $sql);
      echo "<script>alert('Data ditambahkan');window.location='$root';</script>";
    } else {
      $sql = "UPDATE mahasiswa SET nama='$nama', alamat='$alamat' WHERE nim='$id'";
      mysqli_query($koneksi, $sql);
      echo "<script>alert('Data diperbarui');window.location='$root';</script>";
    }
  }

  echo "<h2>".($edit_mode?'Edit':'Tambah')." Data Mahasiswa</h2>
  <form method='post'>
  <table border='1' cellpadding='6' cellspacing='0'>
  <tr><td>NIM*</td><td><input type='text' name='nim' value='$nim' ".($edit_mode?'readonly':'')."></td></tr>
  <tr><td>Nama</td><td><input type='text' name='nama' value='$nama'></td></tr>
  <tr><td>Alamat</td><td><input type='text' name='alamat' value='$alamat'></td></tr>
  <tr><td></td><td><input type='submit' value='Simpan'> <a href='$root'>Batal</a></td></tr>
  </table></form>";
}
?>
