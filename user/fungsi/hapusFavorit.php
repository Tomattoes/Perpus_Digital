<?php
include '../../koneksi.php';

$BukuID = $_GET['id'];
$user = $_GET['user'];

mysqli_query($koneksi, "DELETE FROM koleksipribadi Where UserID=$user and BukuID=$BukuID");
header("location:../Buku.php?id=$BukuID");
