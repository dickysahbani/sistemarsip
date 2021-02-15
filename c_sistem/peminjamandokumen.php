<?php

$page = 'Peminjaman Dokumen';
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
                                    <h2><?=$page;?></h2>
                                </div>
                            </div>
                        </div>
                        <div class="body">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dokumen Dipinjam</th>
                                            <th>Nama Peminjam</th>
                                            <th>Tanggal Peminjaman</th>
                                            <th>Tanggal Pengembalian</th>
                                            <th>Status Peminjaman</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    $data = mysqli_query($koneksi, "SELECT * FROM pinjamarsip, arsipdokumen WHERE pinjamarsip.id_dokumen=arsipdokumen.id_dokumen");
                                
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><center><?=$no++;?></center></td>
                                            <td><?=$d['nama_dokumen'];?></td>
                                            <td><?=$d['nama_peminjam'];?></td>
                                            <td><?=$d['tanggal_pinjam'];?></td>
                                            <td><?=$d['tanggal_pengembalian'];?></td>
                                            <td>
                                            <?php
                                            $statuspinjam = $d['status_peminjaman'];
                                            $id_peminjaman = $d['id_peminjaman'];
                                            if($statuspinjam == 'Proses'){
                                                echo "<a href='detailpeminjaman?id_peminjaman=$id_peminjaman'><button class='btn btn-block btn-danger'>Proses</button></a>";
                                            }if($statuspinjam == 'Selesai'){
                                                echo "<button class='btn btn-block btn-success'>Selesai</button>";
                                            }
                                            ?>
                                     
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
                            <input type="text" class="form-control" placeholder="Nama Lemari" name="nama_lemari">
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
include 'v_footer.php';
?>