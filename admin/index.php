<?php
session_start();
include "koneksi.php";
if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
    header('location:login.php');
} else {
?>
    <!doctype html>
    <html lang="en">

    <?php include "head.php" ?>

    <body>
        <div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header">
            <?php include "header.php" ?>

            <div class="app-main">
                <?php include "sidebar.php" ?>
                <div class="app-main__outer">
                    <?php include "content.php" ?>
                </div>
            </div>
        </div>
        <?php include "footer.php" ?>
    </body>

    </html>
<?php
}
?>