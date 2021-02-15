<?php

$page = 'Laporan Periodik ATK';
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

                        <div class="alert alert-info">Laporan Kondisi ATK Pertanggal <?=date('d F Y');?></div>
                        

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Stok Awal</th>
                                    <th>Stok Akhir</th>
                                    <th>Kondisi Pertanggal</th>
                                </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                  
                                    $data = mysqli_query($koneksi, "SELECT * FROM barang where posisi='$role_lembaga' ");
                             
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><center><?=$no++;?></center></td>
                                            <td><?=$d['nama_barang'];?></td>
                                            <td><?=$d['stok_awal'];?></td>
                                            <td><?=$d['quantity'];?></td>
                                            <td>
                                            <?php
                                            echo date('d F Y');
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