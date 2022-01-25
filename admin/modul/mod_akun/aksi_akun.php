<?php
session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
  header('location:../index.php');
} else {
  include "../../koneksi.php";
  $module = $_GET['module'];
  $act    = $_GET['act'];

  //Input user
  if ($module == 'akun' and $act == 'input') {
    $cekuser = $db->prepare("SELECT username FROM users WHERE username=?");
    $cekuser->bind_param("s", $_POST['username']);
    $cekuser->execute();
    $ada = $cekuser->get_result();
    //kalau user terdeteksi
    if ($ada->num_rows > 0) {
      echo "<script>window.alert('Gagal, Username tidak tersedia');window.location=('../../index.php?module=" . $module . "')</script>";
    } else {
      //user masih bisa digunakan
      $data = $db->prepare("INSERT INTO users(username, password, level, blokir) VALUES(?,?,?,?)");
      $data->bind_param("ssss", $_POST['username'], password_hash($_POST['password'], PASSWORD_DEFAULT), $_POST['level'], $_POST['blokir']);
      $data->execute();
      $data->close();
      header('location:../../index.php?module=' . $module);
    }
  } elseif ($module == 'akun' and $act == 'edit') {
  }
}
