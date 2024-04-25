<?php
include '../../koneksi.php';

$BukuID = $_GET['id'];
$user = $_GET['user'];

$d = mysqli_query($koneksi, "SELECT UserID, BukuID FROM koleksipribadi");
$data = mysqli_fetch_array($d);

if ($data['BukuID'] == $BukuID and $data['UserID'] == $user) {
    echo "<script>alert('Buku ini sudah ada di daftar favorit anda'); window.location='../Buku.php?id=$BukuID';</script>";
}
mysqli_query($koneksi, "INSERT INTO koleksipribadi VALUES ('','$user','$BukuID') ");
header("location:../Buku.php?id=$BukuID");
