<?php 

include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM user WHERE UserID='$id'");

header("location:petugas.php?info=hapus");
?>