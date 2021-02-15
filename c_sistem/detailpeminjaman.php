<?php
$page = 'Detail Peminjaman';
include 'v_header.php';
if ($menu_arsip == 0){
    echo "<script>alert('Anda tidak diperbolehkan akses halaman ini silahka hubungi Kepala Tata Usaha');window.location='index';</script>";
}
$id_peminjaman = $_GET['id_peminjaman'];
if($id_peminjaman == null){
    echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='index.app';</script>";
}
$query = mysqli_query($koneksi, "SELECT * FROM pinjamarsip, arsipdokumen WHERE id_peminjaman='$id_peminjaman' AND pinjamarsip.id_dokumen=arsipdokumen.id_dokumen");
$q = mysqli_fetch_array($query);
$jq = mysqli_num_rows($query);
if($q < 1){
echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='index.app';</script>";
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
                                    <h2><?=$page;?> <?=$q['nama_dokumen'];?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            
                                <center><div class="alert alert-success">Detail Dokumen & Peminjaman</div></center>
                                <table class="table table-hover">
                                    <tr>
                                        <td>Nama Dokumen</td>
                                        <td>:</td>
                                        <td><b><?=$q['nama_dokumen'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Jumlah Dokumen</td>
                                        <td>:</td>
                                        <td><b><?=$q['jumlah_dokumen'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Ruangan</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_ruang_dokumen'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Lemari</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_lemari_dokumen'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Rak</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_rak_dokumen'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Nama Peminjam</td>
                                        <td>:</td>
                                        <td><b><?=$q['nama_peminjam'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Tanggal Peminjaman</td>
                                        <td>:</td>
                                        <td>
                                        <?php 
                                        $tanggal_pinjam = $q['tanggal_pinjam'];
                                        ?>
                                        <b>
                                        <?= date('d F Y', strtotime($tanggal_pinjam)); ?>
                                        </b></td>
                                    </tr>
                                </table>
                                <button class="btn btn-block btn-primary" data-toggle="modal" data-target="#modalkembali">Kembalikan Dokumen</button>
                        </div>
                        
                    </div>
                </div>
            </div>

            
          
              
            </div>
        </div>
    </section>
  
    <div class="modal fade" id="modalkembali" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="defaultModalLabel">Tambah <?=$page;?></h4>
                </div>
            <div class="modal-body">
                <form method="post">
                <form method="post">
                    <div class="form-group">
                        <div class="form-line">
                            <label>Nama Peminjam</label>
                            <input type="text" class="form-control" name="nama_peminjam" value="<?=$q['nama_peminjam']?>" disabled>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="form-line">
                            <label>Tanggal Pengembalian</label>
                            <input type="date" class="form-control" name="tanggal_pengembalian">
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
     $tanggal_pengembalian = mysqli_escape_string($koneksi, $_POST['tanggal_pengembalian']);
     $id_dokumen = $q['id_dokumen'];
     $edit = mysqli_query($koneksi, "UPDATE pinjamarsip SET tanggal_pengembalian='$tanggal_pengembalian', status_peminjaman='Selesai' WHERE id_peminjaman='$id_peminjaman'");
     $edit = mysqli_query($koneksi, "UPDATE arsipdokumen SET status_dokumen='Tersedia' WHERE id_dokumen='$id_dokumen'");
     echo "<script>alert('Peminjaman berhasil di kembalikan');window.location='peminjamandokumen.php';</script>";
 }
 ?>   

    
<?php 
include 'v_footer.php';
?>