<?php
$page = 'Daftar ATK';
include 'v_header.php';
if ($menu_atk == 0){
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
                        <div class="body">
                        <button type="button" class="btn btn-block btn-primary waves-effect" data-toggle="modal" data-target="#tambah">Tambah ATK</button><br><br>

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Quantity Tersedia</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM barang where posisi='$role_lembaga'");
                                
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><center><?=$no++;?></center></td>
                                            <td><?=$d['nama_barang'];?></td>
                                            <td><?=$d['quantity'];?> Pcs</td>
                                            <td>
                                            <button class='btn btn-success' data-toggle="modal" data-target="#tambahstok<?=$d['id_barang']?>">Tambah Stok</button> 
                                            <button class='btn btn-danger' data-toggle="modal" data-target="#pengambilan<?=$d['id_barang']?>">Pengambilan</button> 
                                            <a href="detailbarang?id_barang=<?=$d['id_barang'];?>"><button class='btn btn-warning'>Detail</button></a></td>
                                            </td>
                                        </tr>

    <div class="modal fade" id="tambahstok<?=$d['id_barang']?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Tambah Stok <?=$d['nama_barang'];?></h4>
                </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <div class="form-line">
                            <span>Nama Barang</span>
                            <input type="text" value="<?=$d['id_barang'];?>" name="id_barang" hidden="true">
                            <input type="text" class="form-control" value="<?=$d['nama_barang'];?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Jumlah Sebelumnya</span>
                            <input type="text" class="form-control" value="<?=$d['quantity'];?>"  disabled>
                            <input type="text" value="<?=$d['quantity'];?>" name="quantity_sekarang" hidden="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Jumlah Ditambahkan Pcs</span>
                            <input type="text" class="form-control" name="quantity_tambah">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="tambahstok" class="btn bg-green btn-link waves-effect">SIMPAN</button>
                </form>
                    <button type="button" class="btn bg-red btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

   

    <div class="modal fade" id="pengambilan<?=$d['id_barang']?>" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Pengambilan Barang <?=$d['nama_barang'];?></h4>
                </div>
            <div class="modal-body">
                <form method="post">
                    <div class="form-group">
                        <div class="form-line">
                            <input type="text" value="<?=$d['id_barang'];?>" name="id_barang" hidden="true">
                            <span>Nama Barang</span>
                            <input type="text" class="form-control" value="<?=$d['nama_barang'];?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Jumlah Sebelumnya</span>
                            <input type="text" name="quantity_sebelumnya" value="<?=$d['quantity'];?>" hidden="true">
                            <input type="text" class="form-control" value="<?=$d['quantity'];?> Pcs" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Nama Pengambil</span>
                            <input type="text" class="form-control" name="nama_pengambil">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Uraian</span>
                            <input type="text" class="form-control" name="uraian_pengambil">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <span>Jumlah Yang Diambil</span>
                            <input type="number" class="form-control" name="quantity_keluar">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="pengambilanstok" class="btn bg-green btn-link waves-effect">SIMPAN</button>
                </form>
                    <button type="button" class="btn bg-red btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

                                        

                                        





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
                            <input type="text" class="form-control" placeholder="Nama Barang" name="nama_barang">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <input type="number" class="form-control" placeholder="Quantity / Jumlah Hitungan Pcs" name="quantity">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Posisi Ruangan</label>
                        <select class="form-control" name="posisi_ruang">
                            <option></option>
                        <?php
                        $posisiruang = mysqli_query($koneksi, "SELECT * FROM posisi_ruang");
                        while ($pru = mysqli_fetch_array($posisiruang)){
                        ?>
                            <option value="<?=$pru['nama_ruang']?>"><?=$pru['nama_ruang']?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi Lemari</label>
                        <select class="form-control" name="posisi_lemari">
                            <option></option>
                        <?php
                        $posisilemari = mysqli_query($koneksi, "SELECT * FROM posisi_lemari");
                        while ($ple = mysqli_fetch_array($posisilemari)){
                        ?>
                            <option value="<?=$ple['nama_lemari']?>"><?=$ple['nama_lemari']?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi Rak</label>
                        <select class="form-control" name="posisi_rak">
                            <option></option>
                        <?php
                        $posisirak = mysqli_query($koneksi, "SELECT * FROM posisi_rak");
                        while ($pra = mysqli_fetch_array($posisirak)){
                        ?>
                            <option value="<?=$pra['nama_rak']?>"><?=$pra['nama_rak']?></option>
                        <?php } ?>
                        </select>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="tambahatk" class="btn bg-green btn-link waves-effect">SIMPAN</button>
                </form>
                    <button type="button" class="btn bg-red btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_POST['tambahatk'])){
    $nama_barang = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_barang']));
    $quantity = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['quantity']));
    $posisi_ruang = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_ruang']));
    $posisi_lemari = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_lemari']));
    $posisi_rak = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_rak']));
    $id_atk = date('hisdmy');
    $id_atk2 = SHA1(htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_barang'])));
    $query = mysqli_query($koneksi, "INSERT INTO barang VALUES ('$id_atk-$id_atk2','$nama_barang','$quantity','$quantity','$posisi_ruang','$posisi_lemari','$posisi_rak','$role_lembaga')");
    echo "<script>alert('ATK Berhasil Di Tambahkan');window.location='daftaratk.app';</script>";
}if(isset($_POST['tambahstok'])){
    $id_barang = mysqli_escape_string($koneksi, $_POST['id_barang']);
    $quantity_sebelumnya = mysqli_escape_string($koneksi, $_POST['quantity_sekarang']);
    $quantity_tambah = mysqli_escape_string($koneksi, $_POST['quantity_tambah']);
    $tanggal = date('Y-m-d');
    $waktu = date('h:i:s');
    $query = mysqli_query($koneksi, "INSERT INTO barang_tambah VALUES ('','$id_barang','$quantity_sebelumnya','$quantity_tambah','$tanggal','$waktu')");
    echo "<script>alert('Berhasil Tambah Stok Sejumlah $quantity_tambah');window.location='daftaratk.app';</script>";
}if(isset($_POST['pengambilanstok'])){
    $id_barang = mysqli_escape_string($koneksi, $_POST['id_barang']);
    $quantity_sebelumnya = mysqli_escape_string($koneksi, $_POST['quantity_sebelumnya']);
    $quantity_keluar = mysqli_escape_string($koneksi, $_POST['quantity_keluar']);
    $nama_pengambil = mysqli_escape_string($koneksi, $_POST['nama_pengambil']);
    $uraian_pengambil = mysqli_escape_string($koneksi, $_POST['uraian_pengambil']);
    $tanggal = date('Y-m-d');
    $waktu = date('h:i:s');
    if($quantitiy_sebelumnya < 1){
        $query = mysqli_query($koneksi, "INSERT INTO barang_keluar VALUES ('','$id_barang','$quantity_sebelumnya','$quantity_keluar','$nama_pengambil','$uraian_pengambil','$tanggal','$waktu')");
        echo "<script>alert('Berhasil Diambil Stok Sejumlah $quantity_keluar');window.location='daftaratk.app';</script>";
    }else{
        echo "<script>alert('Tidak Bisa Diambil Di Karenakan Stok 0');window.location='daftaratk.app';</script>";
        
    }
    
}
?>


    


    

    
<?php 
include 'v_footer.php';
?>