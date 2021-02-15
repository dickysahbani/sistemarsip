<?php
$page = 'Manajemen Pengguna';
include 'v_header.php';
if ($role_user == 2){
    echo "<script>alert('Anda tidak diperbolehkan akses halaman ini silahka hubungi Kepala Tata Usaha');window.location='index';</script>";
}
?>

    <section class="content">
        <div class="container-fluid">
        
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2><?=$page;?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="body table-responsive">
                        <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#tambah">Tambah User</button>
                        <br>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>USERNAME</th>
                                        <th>NAMA</th>
                                        <th>JABATAN</th>
                                        <th>AKSI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?PHP
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM user");
                                    while($d = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <td scope="row"><?=$no++?></td>
                                        <td><?=$d['username'];?></td>
                                        <td><?=$d['nama_lengkap'];?></td>
                                        <td><?=$d['jabatan_user'];?></td>
                                        <td>
                                        <button type="button" class="btn bg-blue btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">settings</i>
                                </button>
                                <button type="button" class="btn bg-red btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">restore_from_trash</i>
                                </button>
                                        
                                        </td>
                                    </tr>
                                    <?php } ?>
                                    
                                </tbody>
                            </table>
                        </div>
                        
                    </div>
                </div>
            </div>

            
          
              
            </div>
        </div>
    </section>
  
    <div class="modal fade" id="tambah" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Tambah <?=$page;?></h4>
                </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <div class="form-line">
                            <span>Username</span>
                            <input type="email" class="form-control" name="username" required>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Password</span>
                            <input type="password" class="form-control" name="password" required>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Nama Lengkap</span>
                            <input type="text" class="form-control" name="nama_lengkap" required>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Jabatan</span>
                            <select name="jabatan_user" class="form-control" required>
                                <option></option>
                                <option value="Tata Usaha">Tata Usaha</option>
                                <option value="Kepala Tata Usaha">Kepala Tata Usaha</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Admin User</span>
                            <select name="role_user" class="form-control" required>
                                <option></option>
                                <option value="1">Admin</option>
                                <option value="2">Bukan Admin</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Lembaga (Dapat Diubah)</span>
                            <select name="role_lembaga" class="form-control" required>
                                <option></option>
                                <option value="1">SMA</option>
                                <option value="2">SMK</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Aktif Menu ATK</span>
                            <select name="menu_atk" class="form-control" required>
                                <option></option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <br>
                        <div class="form-line">
                            <span>Aktif Menu Arsip</span>
                            <select name="menu_arsip" class="form-control" required>
                                <option></option>
                                <option value="1">Aktif</option>
                                <option value="0">Tidak Aktif</option>
                            </select>
                        </div>
                        <br>
                    
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn bg-green btn-link waves-effect">SIMPAN</button>
                </form>
                    <button type="button" class="btn bg-red btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

    <?php
    if(isset($_POST['simpan'])){
        $username_sp = mysqli_real_escape_string($koneksi, $_POST['username']);
        $password_sp = SHA1($_POST['password']);
        $nama_lengkap_sp = mysqli_real_escape_string($koneksi, $_POST['nama_lengkap']);
        $jabatan_user_sp = mysqli_real_escape_string($koneksi, $_POST['jabatan_user']);
        $role_user_sp = mysqli_real_escape_string($koneksi, $_POST['role_user']);
        $role_lembaga_sp = mysqli_real_escape_string($koneksi, $_POST['role_lembaga']);
        $menu_atk_sp = mysqli_real_escape_string($koneksi, $_POST['menu_atk']);
        $menu_arsip_sp = mysqli_real_escape_string($koneksi, $_POST['menu_arsip']);
        $id_user_sp = md5($username_sp);
        $simpan = mysqli_query($koneksi, "INSERT INTO user VALUES ('$id_user_sp','$username_sp','$password_sp','$nama_lengkap_sp','$jabatan_user_sp','$role_user_sp','$role_lembaga_sp','$menu_atk_sp','$menu_arsip_sp')");
        echo "<script>alert('User berhasil dibuat');window.location='pengguna';</script>";

    }
    ?>

    
<?php 
include 'v_footer.php';
?>