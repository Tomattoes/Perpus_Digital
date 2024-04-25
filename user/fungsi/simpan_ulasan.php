<?php
include '../../koneksi.php';

$BukuID = $_POST['buku'];
$User = $_POST['user'];
$Rating = $_POST['rating'];
$Ulasan = $_POST['ulasan'];
$Tgl = $_POST['tgl'];

mysqli_query($koneksi, "INSERT INTO ulasanbuku VALUES ('','$User','$BukuID','$Ulasan','$Rating','$Tgl') ");
header("location:../peminjaman.php?info=simpan");
