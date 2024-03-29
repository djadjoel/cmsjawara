<?php
$qry = $db->prepare("SELECT id_modulsub, nama_modulsub, link, path FROM modulsub WHERE link='$module'");
$qry->execute();
$ada = $qry->get_result();
$t = $ada->fetch_object();
$aksi = "modul/mod_" . $u->link . "/aksi_" . $u->link . ".php";
switch ($_GET['act']) {
    default:
        echo '
        <div class="main-card mb-3 card">
            <div class="card-header">
                <a href="?module=' . $t->link . '&act=akunbaru" class="btn btn-sm btn-primary"><i class="fa fa-plus-circle"></i> Tambah Data</a>
            </div>
            <div class="card-body">
                <table id="example" class="table table-sm table-bordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Level</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>';
        $no = 1;
        $qry1 = $db->prepare("SELECT username, level, blokir FROM users");
        $qry1->execute();
        $ada1 = $qry1->get_result();
        while ($r = $ada1->fetch_object()) {
            echo '<tr>
                        <td>' . $no . '</td>
                        <td>' . $r->username . '</td>
                        <td>' . $r->level . '</td>
                        <td>' . $r->blokir . '</td>
                        <td>
                        <div class="btn-group" role="group" aria-label="Basic example">
                            <a href="?module=akun&act=editakun?username=' . $r->username . '" class="btn btn-sm btn-warning"><i class="pe-7s-pen"></i></a>
                            <a href="?module=akun&act=hapusakun?username=' . $r->username . '" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                        </div>                  
                        </td>
                    </tr>';
            $no++;
        }
        echo ' 
                    </tbody>
                </table>
            </div>
        </div>';
        break;

    case "akunbaru":
?>
        <div class="card">
            <div class="card-header">
                Tambahkan akun baru
            </div>
            <form class="needs-validation" novalidate action="<?php echo $aksi ?>?module=<?php echo $u->link ?>&act=input" method="POST">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="userName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="userName" name="username" required>
                            <div class="invalid-feedback">Silahkan isi username</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-sm" id="inputPassword" name="password" required>
                            <div class="invalid-feedback">
                                Password tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="levelUser" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" id="levelUser" required class="custom-select custom-select-sm">
                                <option></option>
                                <option value="user">User</option>
                                <option value="admin">Admin</option>
                                <option value="superadmin">Superadmin</option>
                            </select>
                            <div class="invalid-feedback">
                                Level user tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="blokirUser" class="col-sm-2 col-form-label">Blokir</label>
                        <div class="col-sm-10">
                            <select name="blokir" id="blokirUser" required class="custom-select custom-select-sm">
                                <option></option>
                                <option value="N">Aktif</option>
                                <option value="Y">Non Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                Status user tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
    <?php
        break;
    case "editakun":
        $ambil = $db->prepare("SELECT * FROM users WHERE username=?");
        $ambil->bind_param("s", $_GET['username']);
        $ambil->execute();
        $ada = $ambil->get_result();
        $e = $ada->fetch_object();
    ?>
        <div class="card">
            <div class="card-header">
                Edit akun
            </div>
            <form class="needs-validation" novalidate action="<?php echo $aksi ?>?module=<?php echo $u->link ?>&act=edit" method="POST">
                <input type="hidden" name="username" value="<?php echo $e->username ?>">
                <div class="card-body">
                    <div class="form-group row">
                        <label for="userName" class="col-sm-2 col-form-label">Username</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control form-control-sm" id="userName" name="username" required value="<?php echo $e->username ?>" disabled>
                            <div class="invalid-feedback">Username tidak bisa diubah</div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
                        <div class="col-sm-10">
                            <input type="password" class="form-control form-control-sm" id="inputPassword" name="password" required>
                            <div class="invalid-feedback">
                                Password jika tidak diubah kosongkan saja.
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="levelUser" class="col-sm-2 col-form-label">Level</label>
                        <div class="col-sm-10">
                            <select name="level" id="levelUser" required class="custom-select custom-select-sm">
                                <?php
                                $level = $db->prepare("SELECT level FROM users WHERE level=?");
                                $level->bind_param("s", $e->level);
                                $level->execute();
                                $adalevel = $level->get_result();
                                $v = $adalevel->fetch_object();
                                if ($v->level == 'user') {
                                    echo '
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Superadmin</option>';
                                } elseif ($v->level == 'admin') {
                                    echo '
                                    <option value="user">User</option>
                                    <option value="admin" selected>Admin</option>
                                    <option value="superadmin">Superadmin</option>';
                                } elseif ($v->level == 'superadmin') {
                                    echo '
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin" selected>Superadmin</option>';
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="blokirUser" class="col-sm-2 col-form-label">Blokir</label>
                        <div class="col-sm-10">
                            <select name="blokir" id="blokirUser" required class="custom-select custom-select-sm">
                                <?php
                                $level = $db->prepare("SELECT level FROM users WHERE level=?");
                                $level->bind_param("s", $e->level);
                                $level->execute();
                                $adalevel = $level->get_result();
                                $v = $adalevel->fetch_object();
                                if ($v->level == 'user') {
                                    echo '
                                    <option value="user" selected>User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin">Superadmin</option>';
                                } elseif ($v->level == 'admin') {
                                    echo '
                                    <option value="user">User</option>
                                    <option value="admin" selected>Admin</option>
                                    <option value="superadmin">Superadmin</option>';
                                } elseif ($v->level == 'superadmin') {
                                    echo '
                                    <option value="user">User</option>
                                    <option value="admin">Admin</option>
                                    <option value="superadmin" selected>Superadmin</option>';
                                }
                                ?>
                                <option value="N">Aktif</option>
                                <option value="Y">Non Aktif</option>
                            </select>
                            <div class="invalid-feedback">
                                Status user tidak boleh kosong.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <button type="submit" class="btn btn-sm btn-primary"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </form>
        </div>
<?php
        break;
}
