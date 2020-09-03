<div class="app-main__inner">
    <?php
    if (empty($_SESSION['namauser']) and empty($_SESSION['passuser'])) {
        header('location:login.php');
    } else {
        include "koneksi.php";
        $module = $_GET['module'];
        if ($_GET['module'] == $module) {
            //tampilkan modulnya
            $qry = $db->prepare("SELECT id_modulutama, nama_modulutama, posisi, icon, subheading, link, path, urutan, level_user, level_admin, aktif_modulutama FROM modulutama WHERE aktif_modulutama='Y' AND link='$module'");
            $qry->execute();
            $ada = $qry->get_result();
            $r = $ada->fetch_object();
            $qry2 = $db->prepare("SELECT id_modulsub, id_modulutama, nama_modulsub, subheading, icon, link, path, level_user, level_admin, urutan, aktif_modulsub FROM modulsub WHERE aktif_modulsub='Y' AND link='$module'");
            $qry2->execute();
            $ada2 = $qry2->get_result();
            $u = $ada2->fetch_object();
            if ($ada->num_rows > 0) {
                echo '
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="' . $r->icon . ' icon-gradient bg-mean-fruit"></i>
                            </div>
                            <div>' . $r->nama_modulutama . '
                                <div class="page-title-subheading">' . $r->subheading . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                if ($_SESSION['leveluser'] == 'superadmin') {
                    include "modul/mod_" . $r->path . "/" . $r->link . ".php";
                } elseif ($_SESSION['leveluser'] == 'admin' and $r->level_admin = 'Y') {
                    include "modul/mod_" . $r->path . "/" . $r->link . ".php";
                } elseif ($_SESSION['leveluser'] == 'user' and $r->level_user = 'Y') {
                    include "modul/mod_" . $r->path . "/" . $r->link . ".php";
                } else {
                    echo '
                    <div class="alert alert-danger" role="alert">
                    <h4>Perhatian!</h4>
                    Anda tidak memiliki akses ke menu ini. Silahkan hubungi Administrator.</div>';
                }
            } elseif ($ada2->num_rows > 0) {
                echo '
                <div class="app-page-title">
                    <div class="page-title-wrapper">
                        <div class="page-title-heading">
                            <div class="page-title-icon">
                                <i class="' . $u->icon . ' icon-gradient bg-mean-fruit"></i>
                            </div>
                            <div>' . $u->nama_modulsub . '
                                <div class="page-title-subheading">' . $u->subheading . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';
                if ($_SESSION['leveluser'] == 'superadmin') {
                    include "modul/mod_" . $u->path . "/" . $u->link . ".php";
                } elseif ($_SESSION['leveluser'] == 'admin' and $u->level_admin = 'Y') {
                    include "modul/mod_" . $u->path . "/" . $u->link . ".php";
                } elseif ($_SESSION['leveluser'] == 'user' and $u->level_user = 'Y') {
                    include "modul/mod_" . $u->path . "/" . $u->link . ".php";
                } else {
                    echo '
                    <div class="alert alert-danger" role="alert">
                    <h4>Perhatian!</h4>
                    Anda tidak memiliki akses ke menu ini. Silahkan hubungi Administrator.</div>';
                }
            }
        } else {
            //pesan jika modul/menu nya tidak ada
            echo '
                    <div class="alert alert-danger" role="alert">
                    <h4>Perhatian!</h4>
                    Modul belum tersedia, silahkan hubungi Administrator.</div>';
        }
    }
    ?>
</div>