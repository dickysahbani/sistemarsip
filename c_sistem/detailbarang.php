<?php
$page = 'Detail Barang';
include 'v_header.php';
if ($menu_atk == 0){
    echo "<script>alert('Anda tidak diperbolehkan akses halaman ini silahka hubungi Kepala Tata Usaha');window.location='index';</script>";
}
$id_barang = $_GET['id_barang'];
if($id_barang == null){
    echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='detailbarang.app';</script>";
}
$query = mysqli_query($koneksi, "SELECT * FROM barang WHERE id_barang='$id_barang'");
$q = mysqli_fetch_array($query);
$jq = mysqli_num_rows($query);
if($q < 1){
    echo "<script>alert('Anda Tidak Di Berikan Akses');window.location='detailbarang.app';</script>";
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
                                    <h2><?=$page;?> <?=$q['nama_barang'];?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            
                                <center><div class="alert alert-success">Detail Barang</div></center>
                                <table class="table table-hover">
                                    <tr>
                                        <td>Nama Barang</td>
                                        <td>:</td>
                                        <td><b><?=$q['nama_barang'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Quantity Tersedia</td>
                                        <td>:</td>
                                        <td><b><?=$q['quantity'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Ruangan</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_ruang'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Lemari</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_lemari'];?></b></td>
                                    </tr>
                                    <tr>
                                        <td>Letak Rak</td>
                                        <td>:</td>
                                        <td><b><?=$q['posisi_rak'];?></b></td>
                                    </tr>
                                   
                                </table>

                             
   
                        </div>

                        <textarea id="ckeditor">
                                <h1>History Penambahan & Pengambilan ATK</h1>
                                <br>
                                <b><h3>Penambahan ATK</h3><b>
                                <hr>
                                <?php
                                $datatambah = mysqli_query($koneksi, "SELECT * FROM barang_tambah WHERE id_barang='$id_barang'");
                                $no = 1;
                                while($dt = mysqli_fetch_array($datatambah)){
                                $tanggal = $dt['tanggal'];
                                $quantity_sebelumnya = $dt['quantity_sebelumnya'];
                                $quantitiy_penambahan = $dt['quantity_tambah'];
                                $total = $quantity_sebelumnya + $quantitiy_penambahan;
                                ?>
                                <p><?=$no++;?>. Quantity Sebelumnya : <?=$dt['quantity_sebelumnya'];?> == Penambahan : <?=$dt['quantity_tambah'];?> == Stok Terakhir : <?=$total;?> == Tanggal & Waktu Penambahan : <?= date('d F Y', strtotime($tanggal)); ?> <?=$dt['waktu'];?></p>
                                <?php } ?>

                                <br>
                                <b><h3>Pengurangan ATK</h3><b>
                                <hr>
                                <?php
                                $datakeluar = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id_barang='$id_barang'");
                                $no = 1;
                                while($dk = mysqli_fetch_array($datakeluar)){
                                $tanggal = $dk['tanggal_pengambil'];
                                $quantity_sebelumnyak = $dk['quantity_sebelumnya'];
                                $quantitiy_keluar = $dk['quantity_keluar'];
                                $total = $quantity_sebelumnyak - $quantitiy_keluar;
                                ?>
                                <p><?=$no++;?>. Quantity Sebelumnya : <?=$dk['quantity_sebelumnya'];?> == Quantity Diambil : <?=$dk['quantity_keluar'];?> == Stok Terakhir : <?=$total;?> == Tanggal & Waktu Penambahan : <?= date('d F Y', strtotime($tanggal)); ?> <?=$dk['waktu_pengambil'];?> == Nama Pengambil : <?=$dk['nama_pengambil']?></p>
                                <?php } ?>


                        </textarea>

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
include 'v_footer.php';
?>