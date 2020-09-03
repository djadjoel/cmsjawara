<div class="app-sidebar sidebar-shadow">
    <div class="app-header__logo">
        <div class="logo-src"></div>
        <div class="header__pane ml-auto">
            <div>
                <button type="button" class="hamburger close-sidebar-btn hamburger--elastic" data-class="closed-sidebar">
                    <span class="hamburger-box">
                        <span class="hamburger-inner"></span>
                    </span>
                </button>
            </div>
        </div>
    </div>
    <div class="app-header__mobile-menu">
        <div>
            <button type="button" class="hamburger hamburger--elastic mobile-toggle-nav">
                <span class="hamburger-box">
                    <span class="hamburger-inner"></span>
                </span>
            </button>
        </div>
    </div>
    <div class="app-header__menu">
        <span>
            <button type="button" class="btn-icon btn-icon-only btn btn-primary btn-sm mobile-toggle-header-nav">
                <span class="btn-icon-wrapper">
                    <i class="fa fa-ellipsis-v fa-w-6"></i>
                </span>
            </button>
        </span>
    </div>
    <div class="scrollbar-sidebar">
        <div class="app-sidebar__inner">
            <ul class="vertical-nav-menu">
                <li class="app-sidebar__heading">Menu Utama</li>
                <?php
                $menu = $db->prepare("SELECT id_modulutama, nama_modulutama, posisi, icon, subheading, link, path, urutan, level_user, level_admin, aktif_modulutama FROM modulutama WHERE aktif_modulutama='Y' ORDER BY urutan ASC");
                $menu->execute();
                $ada = $menu->get_result();
                while ($r = $ada->fetch_object()) {
                    $submenu = $db->prepare("SELECT id_modulsub, id_modulutama, nama_modulsub, subheading, link, path, level_user, level_admin, urutan, aktif_modulsub FROM modulsub WHERE aktif_modulsub='Y' AND id_modulutama='$r->id_modulutama' ORDER BY urutan ASC");
                    $submenu->execute();
                    $adasub = $submenu->get_result();
                    if ($adasub->num_rows > 0) {
                        echo '<li>
                        <a href="#"><i class="metismenu-icon ' . $r->icon . '"></i>' . $r->nama_modulutama . '<i class="metismenu-state-icon pe-7s-angle-down caret-left"></i></a>
                        <ul>';
                        while ($w = $adasub->fetch_object()) {
                            echo '<li><a href="?module=' . $w->link . '"><i class="metismenu-icon"></i>' . $w->nama_modulsub . '</a></li>';
                        }
                        echo '
                        </ul>
                    </li>';
                    } else {
                        echo '<li><a href="?module=' . $r->link . '"><i class="metismenu-icon ' . $r->icon . '"></i>' . $r->nama_modulutama . '</a></li>';
                    }
                }
                ?>
                <li><a href="logout.php"><i class="metismenu-icon pe-7s-display2"></i>Keluar</a></li>
            </ul>
        </div>
    </div>
</div>