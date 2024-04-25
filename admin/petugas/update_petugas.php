<?php
include '../../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];

mysqli_query($koneksi, "UPDATE user set NamaLengkap='$nama', Email='$email', Username='$username', Password='$password', No_HP='$no_hp', Alamat='$alamat' WHERE UserID='$id'");

header("location:petugas.php?info=update");
