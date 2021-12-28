<?php
session_start();
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    header('location:login.php');
} else {
    include "../koneksi.php";
    $module = $_GET['module'];
    $act    = $_GET['act'];

    if ($module == 'akun' and $act == 'input') {
        
    }
}
