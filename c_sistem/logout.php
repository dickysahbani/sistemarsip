<?php
session_start();
$_SESSION['id_user']='';
$_SESSION['username']='';
$_SESSION['password']='';
$_SESSION['nama_lengkap']='';
$_SESSION['jabatan_user']='';
$_SESSION['role_user']='';
$_SESSION['role_lembaga']='';

unset($_SESSION['id_user']);
unset($_SESSION['username']);
unset($_SESSION['password']);
unset($_SESSION['nama_lengkap']);
unset($_SESSION['jabatan_user']);
unset($_SESSION['role_lembaga']);

session_unset();
session_destroy();
echo "<script>window.location='../login';</script>";
?>
