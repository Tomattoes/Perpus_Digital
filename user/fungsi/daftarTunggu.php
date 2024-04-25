<?php 
include '../../koneksi.php';

$BukuID = $_GET['id'];
$user = $_GET['user'];

mysqli_query($koneksi, "INSERT INTO koleksipribadi VALUES ('','$user','$BukuID') ");
header("location:../Buku.php?id=$BukuID");
?>