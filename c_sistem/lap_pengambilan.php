<?php

$page = 'Laporan Pengambilan ATK';
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

                        <div class="form-group" align="center">
                        <p>Rentang Waktu Laporan</p>
                            <form method="GET">
                                <span>Tanggal Awal</span><input type="date" name="tanggal_awal" required>
                                <span>Tanggal Akhir</span><input type="date" name="tanggal_akhir" required>
                                <button class="btn btn-primary" name="filter" type="submit" value="<?=sha1($page)?>">Filter Tanggal</button>
                            </form>
                        </div>

                        <?php
                        if(isset($_GET['filter'])){
                            $tanggal_awal = $_GET['tanggal_awal'];
                            $tanggal_akhir = $_GET['tanggal_akhir'];
                            echo '<div class="alert alert-info">Anda Memilih Rentang Tanggal Awal : '.date('d F Y', strtotime($tanggal_awal)).' & Tanggal Akhir : '.date('d F Y', strtotime($tanggal_akhir)).' </div>';
                        }
                        ?>
                        

                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Pengambil</th>
                                    <th>Nama Barang</th>
                                    <th>Keterangan</th>
                                    <th>Jumlah Sebelumnya</th>
                                    <th>Jumlah Diambil</th>
                                    <th>Jumlah Terakhir</th>
                                    <th>Tanggal</th>
                                </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $no = 1;
                                    if(isset($_GET['filter'])){
                                        $tanggal_awal = $_GET['tanggal_awal'];
                                        $tanggal_akhir = $_GET['tanggal_akhir'];
                                        $data = mysqli_query($koneksi, "SELECT * FROM barang_keluar, barang WHERE posisi='$role_lembaga' AND tanggal_pengambil BETWEEN '".$tanggal_awal."' AND '".$tanggal_akhir."' AND barang_keluar.id_barang=barang.id_barang ORDER BY tanggal_pengambil ASC");
                                        $jdata = mysqli_num_rows($data);
                                        if($jdata < 1){
                                            echo "<script>alert('Tidak ditemukan laporan ');window.location='lap_pengambilan.app';</script>";
                                        }
                                    }else{
                                        $data = mysqli_query($koneksi, "SELECT * FROM barang_keluar WHERE id_barang='0'");
                                    }
                                    while ($d = mysqli_fetch_array($data)){
                                    ?>
                                        <tr>
                                            <td><center><?=$no++;?></center></td>
                                            <td><?=$d['nama_pengambil'];?></td>
                                            <td><?=$d['nama_barang'];?></td>
                                            <td><?=$d['uraian_pengambil'];?></td>
                                            <td><?=$d['quantity_keluar'];?></td>
                                            <td><?=$d['quantity_sebelumnya'];?></td>
                                            <td>
                                                <?php
                                                $quantity_sebelumnya = $d['quantity_sebelumnya'];
                                                $quantity_keluar = $d['quantity_keluar'];
                                                $total = $quantity_sebelumnya - $quantity_keluar;
                                                echo $total;
                                                ?>
                                            </td>
                                            <td>
                                            <?php
                                            $tanggal_pengambil = $d['tanggal_pengambil'];
                                            echo date('d F Y', strtotime($tanggal_pengambil));
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