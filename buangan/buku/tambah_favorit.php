<?php 

include '../../koneksi.php';

$id_user = $_GET['id_user'];
$id = $_GET['id'];

mysqli_query($koneksi, "INSERT INTO koleksipribadi VALUES ('','$id_user','$id')");

header("location:daftarBuku.php?info=simpan");
?>