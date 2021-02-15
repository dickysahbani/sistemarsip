<?php
include 'config/c_database.php';
session_start();
if(isset($_SESSION['id_user'])){
  header("Location: c_sistem");
}
?>
<html>

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <title>Login Aplikasi</title>
    <!-- Favicon-->
    <link rel="icon" href="asset/images/iconpgri.png" type="image/x-icon">
    <link href="asset/google2.css" rel="stylesheet">
    <link href="asset/google.css" rel="stylesheet">

    <!-- Bootstrap Core Css -->
    <link href="asset/plugins/bootstrap/css/bootstrap.css" rel="stylesheet">

    <!-- Waves Effect Css -->
    <link href="asset/plugins/node-waves/waves.css" rel="stylesheet" />

    <!-- Animation Css -->
    <link href="asset/plugins/animate-css/animate.css" rel="stylesheet" />

    <!-- Custom Css -->
    <link href="asset/css/style.css" rel="stylesheet">
</head>

<body class="login-page">
    <div class="login-box">
        <div class="logo">
            <a href="javascript:void(0);">Aplikasi Arsip & ATK</a>
            <small>SMA - SMK PGRI 109</small>
        </div>
        <div class="card">
            <div class="body">
                <form id="sign_in" method="POST">
                    <div class="msg">Silahkan Masuk Untuk Menggunakan Sistem</div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">person</i>
                        </span>
                        <div class="form-line">
                            <input type="text" class="form-control" name="username" placeholder="Username" required>
                        </div>
                    </div>
                    <div class="input-group">
                        <span class="input-group-addon">
                            <i class="material-icons">lock</i>
                        </span>
                        <div class="form-line">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn btn-block bg-pink waves-effect" type="submit" name="masuk">Masuk Aplikasi</button>
                        </div>
                    </div>
                
                </form>
            </div>
        </div>
    </div>
    <?php
  if(isset($_POST['masuk'])){
    $username = mysqli_escape_string($koneksi,$_POST['username']);
    $password = SHA1(trim(mysqli_escape_string($koneksi,$_POST['password'])));
    $sql = "select * from user where username='".$username."' and password='".$password."' limit 1";
    $enkrip = base64_encode($username);
    $hasil = mysqli_query ($koneksi,$sql);
    $jumlah = mysqli_num_rows($hasil);
      if ($jumlah>0){
        $row = mysqli_fetch_assoc($hasil);
        $_SESSION['id_user']=$row['id_user'];
        $_SESSION['username']=$row['username'];
        $_SESSION['password']=$row['password'];
        $_SESSION['nama_lengkap']=$row['nama_lengkap'];
        $_SESSION['jabatan_user']=$row['jabatan_user'];
        $_SESSION['role_user']=$row['role_user'];
        $_SESSION['role_lembaga']=$row['role_lembaga'];
        echo "<script>window.location='c_sistem?token=$enkrip';</script>";
      }else{
        echo "<script>alert('Password anda salah');</script>";
      } 
  }
?>

    <script src="asset/plugins/jquery/jquery.min.js"></script>
    <script src="asset/plugins/bootstrap/js/bootstrap.js"></script>
    <script src="asset/plugins/node-waves/waves.js"></script>
    <script src="asset/plugins/jquery-validation/jquery.validate.js"></script>
    <script src="asset/js/admin.js"></script>
    <script src="asset/js/pages/examples/sign-in.js"></script>
</body>

</html>