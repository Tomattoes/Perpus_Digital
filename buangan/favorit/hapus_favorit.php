<?php 

include '../../koneksi.php';

$id = $_GET['id'];

mysqli_query($koneksi, "DELETE FROM koleksipribadi WHERE KoleksiID='$id'");

header("location:favorit.php?info=hapus");
?>