<?php

include '../../koneksi.php';

$id = $_POST['id'];
$id_member = $_POST['id_member'];
$nama_member = $_POST['nama_member'];
$judul = $_POST['judul'];
$tgl_dikembalikan = $_POST['tgl_dikembalikan'];
$denda = $_POST['denda'];
$jumlah_bayar = $_POST['jumlah_bayar'];

$calculate = $denda - $jumlah_bayar;

if ($jumlah_bayar > $denda) {
    echo "<script>alert('Bayar Uang Sesuai dengan Denda yang Tertera!'); window.location.assign('formBayarDenda.php?id=$id');</script>";
} elseif ($jumlah_bayar < $denda) {
    echo "<script>alert('Bayar Uang Sesuai dengan Denda yang Tertera!'); window.location.assign('formBayarDenda.php?id=$id');</script>";
} else {
   $q1 = mysqli_query($koneksi, "UPDATE peminjaman SET denda='$calculate' WHERE PeminjamanID='$id'");
   $q2 = mysqli_query($koneksi, "INSERT INTO Denda VALUES ('','$id','$denda')");
    header("location:daftarDenda.php?info=sukses");
}
