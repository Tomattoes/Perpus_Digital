<?php 

include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM buku WHERE BukuID='$id'");

header("location:daftarbuku.php?info=hapus");
?>