<?php
include '../../koneksi.php';

$id = $_POST['id'];
$idBuku = $_POST['idBuku'];
$rating = $_POST['rating'];
$ulasan = $_POST['ulasan'];

mysqli_query($koneksi, "INSERT INTO ulasanbuku VALUES ('','$id','$idBuku','$ulasan','$rating')");

header("location:daftarBuku.php?info=sukses");

