<?php
$dbhost = "localhost";
$dbuser = "root";
$dbpass = "";
$dbname = "db_jawara";
$db     = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($db->connect_errno) {
    echo 'Gagal koneksi ke database';
}
