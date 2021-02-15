<?php
error_reporting(0);
include '../config/c_config.php';
include '../config/c_database.php';
session_start();
if (!isset($_SESSION["username"])) {
  echo "<script>alert('Harap Login Terlebih Dahulu');window.location='../login';</script>";
}

$id_user=$_SESSION["id_user"];
$querylogin = mysqli_query($koneksi, "SELECT * FROM user WHERE id_user='$id_user'");
$ql = mysqli_fetch_array($querylogin);
$username = $ql['username'];
$passoword = $ql['password'];
$nama_lengkap = $ql['nama_lengkap'];
$jabatan_user = $ql['jabatan_user'];
$role_user = $ql['role_user'];
$role_lembaga = $ql['role_lembaga'];
$menu_atk = $ql['menu_atk'];
$menu_arsip = $ql['menu_arsip'];
?>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=Edge">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title><?=$page;?> Sitem Pengelolaan Arsip & ATK</title>
    <link rel="icon" href="../asset/images/iconpgri.png" type="image/x-icon">
    <link href="../asset/google2.css" rel="stylesheet">
    <link href="../asset/google.css" rel="stylesheet">
    <link href="../asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">
    <link href="../asset/plugins/node-waves/waves.css" rel="stylesheet" />
    <link href="../asset/plugins/animate-css/animate.css" rel="stylesheet" />
    <link href="../asset/plugins/morrisjs/morris.css" rel="stylesheet" />
    <link href="../asset/css/style.css" rel="stylesheet">
    <link href="../asset/css/themes/all-themes.css" rel="stylesheet" />
    <link href="../asset/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
    <link href="../asset/plugins/jquery-datatable/skin/bootstrap/css/dataTables.bootstrap.css" rel="stylesheet">
</head>

<body class="theme-blue">

    <div class="page-loader-wrapper">
        <div class="loader">
            <div class="preloader">
                <div class="spinner-layer pl-red">
                    <div class="circle-clipper left">
                        <div class="circle"></div>
                    </div>
                    <div class="circle-clipper right">
                        <div class="circle"></div>
                    </div>
                </div>
            </div>
            <p>Sedang Loading...</p>
        </div>
    </div>

    <div class="overlay"></div>


    <nav class="navbar">
        <div class="container-fluid">
            <div class="navbar-header">
                <a href="javascript:void(0);" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse" aria-expanded="false"></a>
                <a href="javascript:void(0);" class="bars"></a>
                <a class="navbar-brand" href="index"><?=$namaapp;?> | <?=$page;?></a>
            </div>
        </div>
    </nav>

    <section>
        <aside id="leftsidebar" class="sidebar">
          <br>
            <div class="menu">
                <div align="center">
                    <img src="../asset/images/sekolah.png" width="80" height="80">
                    <h5><?=$nama_lengkap;?></h5><p><?=$jabatan_user;?> 
                    <?php
                    $rolelembaga = $role_lembaga;
                    if($rolelembaga == 1){
                        ECHO 'SMA';
                    }if($rolelembaga == 2){
                        ECHO 'SMK';
                    }
                    ?>
                    </p>
                </div>
                <ul class="list">
                    <li class="header">MENU APLIKASI</li>
                    <li <?php if($page == 'Dashboard'){ echo 'class="active"'; } ?>>
                        <a href="index.app">
                            <i class="material-icons">home</i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li <?php if($page == 'Arsip Dokumen'){ echo 'class="active"'; } ?> <?php if($menu_arsip == 0){ echo 'hidden';}?>>
                        <a href="arsipdokumen.app">
                            <i class="material-icons">assignment</i>
                            <span>Arsip Dokumen</span>
                        </a>
                    </li>
                    <li <?php if($page == 'Peminjaman Dokumen'){ echo 'class="active"'; } ?> <?php if($menu_arsip == 0){ echo 'hidden';}?>>
                        <a href="peminjamandokumen.app">
                            <i class="material-icons">text_snippet</i>
                            <span>Peminjaman Dokumen</span>
                        </a>
                    </li>
                    <li <?php if($page == 'Daftar ATK'){ echo 'class="active"'; } ?> <?php if($menu_atk == 0){ echo 'hidden';}?>>
                        <a href="daftaratk.app">
                            <i class="material-icons">rate_review</i>
                            <span>Daftar ATK</span>
                        </a>
                    </li>

                    <li <?php if($menu_atk == 0){ echo 'hidden';}?>>
                        <a href="javascript:void(0);" class="menu-toggle" >
                            <i class="material-icons">article</i>
                            <span>Laporan ATK</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($page == 'Laporan Pengambilan ATK'){ echo 'class="active"'; } ?>>
                                <a href="lap_pengambilan.app">Laporan Pengambilan ATK</a>
                            </li>
                            <li <?php if($page == 'Laporan Penambahan ATK'){ echo 'class="active"'; } ?>>
                                <a href="lap_penambahan.app">Laporan Penambahan ATK</a>
                            </li>
                            <li <?php if($page == 'Laporan Periodik ATK'){ echo 'class="active"'; } ?>>
                                <a href="lap_atk.app">Laporan Periodik ATK</a>
                            </li>
                        </ul>
 
                    </li>
                    
                    <li>
                        <a href="javascript:void(0);" class="menu-toggle">
                            <i class="material-icons">view_list</i>
                            <span>Data Master</span>
                        </a>
                        <ul class="ml-menu">
                            <li <?php if($page == 'Posisi Ruang'){ echo 'class="active"'; } ?>>
                                <a href="po_ruang.app">Posisi Ruang</a>
                            </li>
                            <li <?php if($page == 'Posisi Lemari'){ echo 'class="active"'; } ?>>
                                <a href="po_lemari.app">Posisi Lemari</a>
                            </li>
                            <li <?php if($page == 'Posisi Rak'){ echo 'class="active"'; } ?>>
                                <a href="po_rak.app">Posisi Rak</a>
                            </li>
                        </ul>
                    </li>
                    <li <?php if($page == 'Manajemen Pengguna'){ echo 'class="active"'; } ?> <?php if($role_user == 2){ echo 'hidden';}?>>
                        <a href="pengguna.app">
                            <i class="material-icons">manage_accounts</i>
                            <span>Manajemen Pengguna</span>
                        </a>
                    </li>
                    <li>
                        <a href="logout">
                            <i class="material-icons">logout</i>
                            <span>Keluar Aplikasi</span>
                        </a>
                    </li>
                   
                </ul>
            </div>

            <div class="legal">
                <div class="copyright">
                   <?=$footer;?>
                </div>
            </div>
        </aside>