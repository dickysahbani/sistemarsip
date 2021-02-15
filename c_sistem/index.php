<?php
$page = 'Dashboard';
include 'v_header.php';
?>

    <section class="content">
        <div class="container-fluid">
            <div class="alert alert-info">Aplikasi Pengelolaan Arsip & ATK <b>Versi 1.0</b></div>
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-blue hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">assignment</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Dokumen</div>
                            <?php
                            $jumlahdokumen = mysqli_query($koneksi, "SELECT * FROM arsipdokumen");
                            $jumlahdok = mysqli_num_rows($jumlahdokumen);
                            ?>
                            <div class="number"><?=$jumlahdok;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-teal hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">rate_review</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah ATK SMA</div>
                            <?php
                            $jumlahatksma = mysqli_query($koneksi, "SELECT * FROM barang WHERE posisi='1'");
                            $jumlahatks = mysqli_num_rows($jumlahatksma);
                            ?>
                            <div class="number"><?=$jumlahatks;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-deep-orange hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">rate_review</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah ATK SMK</div>
                            <?php
                            $jumlahatksmk = mysqli_query($koneksi, "SELECT * FROM barang WHERE posisi='2'");
                            $jumlahatksk = mysqli_num_rows($jumlahatksmk);
                            ?>
                            <div class="number"><?=$jumlahatksk;?></div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="info-box-2 bg-green hover-zoom-effect">
                        <div class="icon">
                            <i class="material-icons">add_reaction</i>
                        </div>
                        <div class="content">
                            <div class="text">Jumlah Pengguna</div>
                            <?php
                            $jumlahpengguna = mysqli_query($koneksi, "SELECT * FROM user");
                            $jumlahp = mysqli_num_rows($jumlahpengguna);
                            ?>
                            <div class="number"><?=$jumlahp;?></div>
                        </div>
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Pusat Informasi & Pengumuman</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <?php
                            if($role_user == 1){
                                echo "<button class='btn btn-block btn-primary' data-toggle='modal' data-target='#ubahlembaga'>Ubah Lembaga Khusus ATK</button>";
                            }
                            ?>
                      
                        </div>
                        
                    </div>
                </div>

                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Pusat Unduhan</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <table class="table table-hover">
                            <tr>
                            <th>No</th>
                            <th>Judul Unduhan</th>
                            <th>Aksi</th>
                            </tr>
                            <tr>
                            <td>1</td>
                            <td>Sedang Dalam Perbaikan</td>
                            <td> <button type="button" class="btn bg-light-blue btn-circle waves-effect waves-circle waves-float">
                                    <i class="material-icons">download</i>
                                </button></td>
                            </tr>
                            </table>
                        </div>
                        
                    </div>
                </div>


            </div>
            
<div class="modal fade" id="ubahlembaga" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Ubah Lembaga</h4>
                </div>
            <div class="modal-body">
                <?php
                if($role_lembaga == 1){
                    echo '<div class="alert alert-info">Anda berada di lembaga SMA</div>';
                }if($role_lembaga == 2){
                    echo '<div class="alert alert-info">Anda berada di lembaga SMK</div>';
                }
                ?>
                <form method="post">
                    <div class="form-group">
                        <select name="ubah_lembaga" class="form-control">
                            <option value="1">SMA</option>
                            <option value="2">SMK</option>
                        </select>
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
        if(isset($_POST['ubah_lembaga'])){
            $ubah_lembaga = $_POST['ubah_lembaga'];
            $ubahlembaga = mysqli_query($koneksi, "UPDATE user SET role_lembaga='$ubah_lembaga' WHERE id_user='$id_user'");
            echo "<script>alert('Role lembaga berhasil di ubah');window.location='index';</script>";
        }
    ?>

            
              
           
        </div>
    </section>

<?php 
include 'v_footer.php';
?>