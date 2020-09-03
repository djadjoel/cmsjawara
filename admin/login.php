<?php
session_start();
include "koneksi.php";
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Aplikasi website Jawara Banten">
    <meta name="author" content="Jawara">
    <meta name="generator" content="Jekyll v4.1.1">
    <title>Login Administrator</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/4.5/examples/sign-in/">

    <!-- Bootstrap core CSS -->
    <link href="../layout/css/bootstrap.min.css" rel="stylesheet">

    <style>
        .bd-placeholder-img {
            font-size: 1.125rem;
            text-anchor: middle;
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        @media (min-width: 768px) {
            .bd-placeholder-img-lg {
                font-size: 3.5rem;
            }
        }
    </style>
    <!-- Custom styles for this template -->
    <link href="assets/signin.css" rel="stylesheet">
</head>

<body class="text-center">
    <form class="form-signin" action="cek_login.php" method="POST" autocomplete="off">
        <img class="mb-4" src="../assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
        <h1 class="h3 mb-3 font-weight-normal">Silahkan Login</h1>
        <?php
        if (!empty($_GET['msg'])) {
            if ($_GET['msg'] == 1) {
                echo '<div class="alert alert-danger" role="alert">Apakah Anda robot?</div>';
            } elseif ($_GET['msg'] == 2) {
                echo '<div class="alert alert-danger" role="alert">Akun Anda di blokir</div>';
            } elseif ($_GET['msg'] == 3) {
                echo '<div class="alert alert-danger" role="alert">Cek kembali username dan password Anda</div>';
            }
        }
        ?>
        <label for="username" class="sr-only">Username</label>
        <input type="text" id="username" class="form-control" placeholder="Masukkan username" name="username" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required name="password">
        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" value="remember-me"> Remember me
            </label>
        </div>
        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2020</p>
    </form>
</body>

</html>