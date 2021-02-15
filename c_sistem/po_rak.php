<?php
$page = 'Posisi Rak';
include 'v_header.php';
?>

    <section class="content">
        <div class="container-fluid">
        
            <div class="row clearfix">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Posisi Rak</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        <button type="button" class="btn btn-block btn-primary waves-effect" data-toggle="modal" data-target="#tambah">Tambah rak</button><br>
                        
                        <table class="table table-condensed">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Id Rak</th>
                                        <th>Nama Rak</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM posisi_rak ORDER BY nama_rak ASC");
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                    <tr>
                                        <th scope="row"><?=$no++?></th>
                                        <td><?=$d['id_rak'];?></td>
                                        <td><?=$d['nama_rak'];?></td>
                                        <td>
                                                <form method="POST">
                                                <input type="text" name="id_rak" value="<?=$d['id_rak'];?>" hidden>
                                                <button name="hapus" type="submit" class="btn bg-red btn-circle waves-effect waves-circle waves-float"><i class="material-icons">delete</i></button></a>
                                                </form>
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
                            <input type="text" class="form-control" placeholder="Nama Rak" name="nama_rak">
                        </div>
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
        session_start();
        $nama_rak = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_rak']));
        $id_rak = md5(htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_rak'])));
        $tanggal = date('d/m/Y');
        $simpan = mysqli_query($koneksi, "INSERT INTO posisi_rak VALUES('$id_rak','$nama_rak','$tanggal')");
        echo "<script>alert('Posisi Rak Berhasil Ditambahkan');window.location='po_rak.app';</script>";
    }if(isset($_POST['hapus'])){
        session_start();
        $id_rak = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['id_rak']));
        $hapus = mysqli_query($koneksi, "DELETE FROM posisi_rak WHERE id_rak='$id_rak'");
        echo "<script>alert('Posisi Rak Berhasil Dihapus');window.location='po_rak.app';</script>";
    }
    ?>  
    
<?php 
include 'v_footer.php';
?>