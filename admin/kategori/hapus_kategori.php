<?php 

include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM kategoribuku WHERE KategoriID='$id'");

header("location:kategori.php?info=hapus");
?>