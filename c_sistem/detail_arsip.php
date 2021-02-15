<?php
$page = 'Detail Arsip';
include 'v_header.php';
if ($menu_arsip == 0){
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
                                    <h2><button class="btn btn btn-warning" onclick="history.back(-1)">Back</button> <?=$page;?> </h2>
                                </div>
                            </div>
                        </div>

                        
                        <form method="post">
                        <div class="body">
                        <?php
                        $id_dokumen = $_GET['id_dokumen'];

                        $data = mysqli_query($koneksi, "SELECT * FROM arsipdokumen WHERE id_dokumen='$id_dokumen'");
                        $jumlahdata = mysqli_num_rows($data);
                        if($jumlahdata < 1){
                            echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='index.app';</script>";
                        }if($id_dokumen == null){
                            echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='index.app';</script>";
                        }
                        $d = mysqli_fetch_array($data);
                        ?>

                    <div class="form-group">
                        <label>Nama Dokumen</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="nama_dokumen" value="<?=$d['nama_dokumen'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Dokumen</label>
                        <div class="form-line">
                            <input type="number" class="form-control" name="jumlah_dokumen" value="<?=$d['jumlah_dokumen'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Posisi Ruangan</label>
                        <select class="form-control" name="posisi_ruang_dokumen">
                            <option></option>
                        <?php
                        $posisiruang = mysqli_query($koneksi, "SELECT * FROM posisi_ruang");
                        $poruangan = $d['posisi_ruang_dokumen'];
                        while ($pru = mysqli_fetch_array($posisiruang)){
                        ?>
                            <option value="<?=$pru['nama_ruang'];?>" <?php if($pru['nama_ruang']==$poruangan){echo'selected';} ?> ><?=$pru['nama_ruang'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi Lemari</label>
                        <select class="form-control" name="posisi_lemari_dokumen">
                            <option></option>
                        <?php
                        $posisilemari = mysqli_query($koneksi, "SELECT * FROM posisi_lemari");
                        $polemari = $d['posisi_lemari_dokumen'];
                        while ($ple = mysqli_fetch_array($posisilemari)){
                        ?>
                            <option value="<?=$ple['nama_lemari'];?>" <?php if($ple['nama_lemari']==$polemari){echo'selected';} ?> ><?=$ple['nama_lemari'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Posisi Rak</label>
                        <select class="form-control" name="posisi_rak_dokumen">
                            <option></option>
                        <?php
                        $posisirak = mysqli_query($koneksi, "SELECT * FROM posisi_rak");
                        $porak = $d['posisi_rak_dokumen'];
                        while ($prak = mysqli_fetch_array($posisirak)){
                        ?>
                            <option value="<?=$prak['nama_rak'];?>" <?php if($prak['nama_rak']==$porak){echo'selected';} ?> ><?=$prak['nama_rak'];?></option>
                        <?php } ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Dokumen</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="keterangan_dokumen" value="<?=$d['keterangan_dokumen'];?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Status Dokumen</label>
                        <div class="form-line">
                            <input type="text" class="form-control" name="status_dokumen" value="<?=$d['status_dokumen'];?>" disabled>
                        </div>
                    </div>
                    
                    <div class="form-group" align="center">
                    <button class="btn btn-lg btn-block btn-success" name="ubah" type="submit">Ubah Data</button>
                    </form>
                    
                    </div>
                    
                        </div>
                        <?php
                        $statusdok = $d['status_dokumen'];
                        if($statusdok == 'Terpinjam'){
                            echo '<button class="btn btn-block btn-danger" data-toggle="modal" data-target="#modalpinjam" disabled>Pinjam Dokumen</button>';
                        }else{
                            echo '<button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalpinjam">Pinjam Dokumen</button>';
                        }
                        ?>
                        
                    </div>
                </div>
            </div>

            <?php
            if(isset($_POST['ubah'])){
                $id_dokumen = $_GET['id_dokumen'];
                $nama_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_dokumen']));
                $jumlah_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['jumlah_dokumen']));
                $keterangan_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['keterangan_dokumen']));
                $posisi_ruang_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_ruang_dokumen']));
                $posisi_lemari_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_lemari_dokumen']));
                $posisi_rak_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_rak_dokumen']));
                $ubah = mysqli_query($koneksi, "UPDATE arsipdokumen SET 
                nama_dokumen='$nama_dokumen', 
                jumlah_dokumen='$jumlah_dokumen', 
                keterangan_dokumen='$keterangan_dokumen', 
                posisi_ruang_dokumen='$posisi_ruang_dokumen', 
                posisi_lemari_dokumen='$posisi_lemari_dokumen', 
                posisi_rak_dokumen='$posisi_rak_dokumen' WHERE id_dokumen='$id_dokumen'");
                echo "<script>alert('Data Berhasil Di Ubah');window.location='javascript:history.back()';</script>";
            }
            ?>
          
              
            </div>
        </div>
    </section>
    
    <div class="modal fade" id="modalpinjam" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Tambah Peminjaman</h4>
                </div>
            <div class="modal-body">

                <form method="post">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control" placeholder="Masukan Nama Peminjam" name="nama_peminjam">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Tanggal Peminjaman</label>
                            <input type="date" class="form-control" name="tanggal_peminjaman">
                        </div>
                    </div>
            </div>
                <div class="modal-footer">
                    <button type="submit" name="simpan" class="btn bg-green btn-link waves-effect" name="simpan">SIMPAN</button>
                </form>
                    <button type="button" class="btn bg-red btn-link waves-effect" data-dismiss="modal">TUTUP</button>
                </div>
            </div>
        </div>
    </div>

<?php
if(isset($_POST['simpan'])){
    $id_dokumen = $_GET['id_dokumen'];
    $nama_peminjam = mysqli_escape_string($koneksi, $_POST['nama_peminjam']);
    $tanggal_pinjam = $_POST['tanggal_peminjaman'];
    $tersimpan = mysqli_query($koneksi, "INSERT INTO pinjamarsip VALUES('','$id_dokumen','$nama_peminjam','$tanggal_pinjam','','Proses')");
    $pinjam = mysqli_query($koneksi, "UPDATE arsipdokumen SET status_dokumen='Terpinjam' WHERE id_dokumen='$id_dokumen'");
    echo "<script>alert('Peminjaman berhasil di tambahkan');window.location='peminjamandokumen.php';</script>";
}
?>
    

    
<?php 
include 'v_footer.php';
?>