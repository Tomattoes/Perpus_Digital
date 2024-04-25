<?php 
include '../../koneksi.php';

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(UserID) as kodeTerbesar FROM user");
$data = mysqli_fetch_array($query);
$kode = $data['kodeTerbesar'];
 
// mengambil angka dari kode  terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kode, 3, 3);
 
// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
$huruf = "3";
$kode = $huruf . sprintf("%03s", $urutan);
$ID = $kode;
$nama = $_POST['nama'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$role ='petugas';
$tgl =$_POST['tgl_pendaftaran'];

mysqli_query($koneksi, "INSERT INTO user VALUES ('$ID','$username','$password','$email','$nama','$no_hp','$alamat','$role','$tgl')");

header("location:petugas.php?info=simpan");
?>