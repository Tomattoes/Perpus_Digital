<?php 

include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM kategoribuku_relasi WHERE KategoriBukuID='$id'");

header("location:kategori_buku.php?info=hapus");
?>