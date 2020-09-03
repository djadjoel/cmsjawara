<?php
$qry = $db->prepare("SELECT id_modulsub, nama_modulsub, link, path FROM modulsub WHERE link='$module'");
$qry->execute();
$ada = $qry->get_result();
$t = $ada->fetch_object();
switch ($_GET['act']) {
    default:
        echo '<div class="card">
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
                        <td></td>
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
        echo 'disini fasilitas tambah data';
        break;
}
