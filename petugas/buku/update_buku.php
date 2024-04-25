<?php
include '../../koneksi.php';

$id = $_POST['id'];
// $cover = upload();
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
// $kategori = $_POST['kategori'];
$jumlah_halaman = $_POST['jumlah_halaman'];
$stok = $_POST['stok'];

mysqli_query($koneksi, "UPDATE buku set Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahun_terbit', jumlah_halaman='$jumlah_halaman', stok='$stok' WHERE BukuID='$id'");

header("location:daftarbuku.php?info=update");
