<?php
$page = 'Arsip Dokumen';
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
                                    <h2>Pencarian Dokumen</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                            <div class="form-group">
                            <form method="post" action="arsipdokumen">
                                <div class="form-line">
                                    <input type="text" class="form-control" placeholder="Cari Arsip Dokumen" name="cari" required>
                                </div>
                                <br>
                                <div class="col-md-14">
                                    <button class="btn btn-block bg-blue waves-effect" type="submit">Cari Data</button>
                                 </div>
                            </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="header">
                            <div class="row clearfix">
                                <div class="col-xs-12 col-sm-6">
                                    <h2>Arsip Dokumen</h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        <button type="button" class="btn btn-block btn-primary waves-effect" data-toggle="modal" data-target="#tambah">Tambah Dokumen</button><br>
                        <br>
                        <?php
                        if(isset($_POST['cari'])){
                            $cari = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['cari']));
                            echo "<div class='alert alert-success'>Anda Telah Mencari <b>$cari</b></div>";
                        }
                        ?>

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Dokumen</th>
                                            <th>Jumlah</th>
                                            <th>Posisi Ruang</th>
                                            <th>Posisi Lemari</th>
                                            <th>Posisi Rak</th>
                                            <th>Status</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    if(isset($_POST['cari'])){
                                        $cari = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['cari']));
                                        $data = mysqli_query($koneksi, "SELECT * FROM arsipdokumen WHERE nama_dokumen LIKE '%".$cari."%' AND status_dokumen='Tersedia' OR status_dokumen='Terpinjam'");
                                        $rdata = mysqli_num_rows($data);
                                        if($rdata == '0'){
                                            echo "<script>alert('Data Yang Anda Cari Tidak Ditemukan');</script>";
                                        }
                                    }
                                    else{
                                        $data = mysqli_query($koneksi, "SELECT * FROM arsipdokumen WHERE status_dokumen='Tersedia' OR status_dokumen='Terpinjam' ORDER BY nama_dokumen ASC");
                                    }
                                    
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><center><?=$no++;?></center></td>
                                            <td><?=$d['nama_dokumen'];?></td>
                                            <td><center><?=$d['jumlah_dokumen'];?></center></td>
                                            <td><?=$d['posisi_ruang_dokumen'];?></td>
                                            <td><?=$d['posisi_lemari_dokumen'];?></td>
                                            <td><?=$d['posisi_rak_dokumen'];?></td>
                                            <td>
                                            <?php
                                            $st = $d['status_dokumen'];
                                            if($st == 'Tersedia'){
                                                echo "<center><button class='btn btn-block btn-success'>Ada</button></center>";
                                            }if($st == 'Terpinjam'){
                                                echo "<center><button class='btn btn-block btn-danger'>Terpinjam</button></center>";
                                            }
                                            ?>
                                            </td>
                                            <td> 
                                            <a href="detail_arsip?id_dokumen=<?=$d['id_dokumen'];?>"><button type="button" class="btn bg-deep-purple btn-circle waves-effect waves-circle waves-float" type="submit"><i class="material-icons">settings</i></button></a>
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
                        <label>Nama Dokumen</label>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Nama / Isi Dokumen" name="nama_dokumen" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Jumlah Dokumen</label>
                        <div class="form-line">
                            <input type="number" class="form-control" placeholder="Jumlah Dokumen" name="jumlah_dokumen" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Keterangan Dokumen</label>
                        <div class="form-line">
                            <input type="text" class="form-control" placeholder="Keterangan Dokumen" name="keterangan_dokumen" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Posisi Ruangan</label>
                        <select class="form-control" name="posisi_ruang_dokumen">
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
                        <select class="form-control" name="posisi_lemari_dokumen">
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
                        <select class="form-control" name="posisi_rak_dokumen">
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
        $nama_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_dokumen']));
        $jumlah_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['jumlah_dokumen']));
        $keterangan_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['keterangan_dokumen']));
        $posisi_ruang_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_ruang_dokumen']));
        $posisi_lemari_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_lemari_dokumen']));
        $posisi_rak_dokumen = htmlspecialchars(mysqli_escape_string($koneksi, $_POST['posisi_rak_dokumen']));
        $status_dokumen = 'Tersedia';
        $tanggal = date('d/m/Y');
        $id_dokumen1 = date('hisdmy');
        $id_dokumen2 = SHA1(htmlspecialchars(mysqli_escape_string($koneksi, $_POST['nama_dokumen'])));
        $simpan = mysqli_query($koneksi, "INSERT INTO arsipdokumen VALUES ('$id_dokumen1-$id_dokumen2','$nama_dokumen','$jumlah_dokumen','$keterangan_dokumen','$posisi_ruang_dokumen','$posisi_lemari_dokumen','$posisi_rak_dokumen','$status_dokumen','$tanggal')");
        echo "<script>alert('Dokumen Berhasil Di Tambahkan');window.location='arsipdokumen.app';</script>";
    }
    ?>  




<?php 

include 'v_footer.php';
?>
