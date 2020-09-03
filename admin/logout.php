<?php
session_start();
include "koneksi.php";
$db->close();
session_destroy();
header('location:login.php');
