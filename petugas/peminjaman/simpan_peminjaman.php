<?php
include '../../koneksi.php';

$buku = $_POST['buku'];
$member = $_POST['member'];
$petugas = $_POST['id_petugas'];
$tgl_peminjaman = $_POST['tgl_peminjaman'];
$tgl_pengembalian = $_POST['tgl_pengembalian'];
$status = 'dipinjam';

mysqli_query($koneksi, "INSERT INTO peminjaman VALUES ('','$member','$buku','$petugas','$tgl_peminjaman','$tgl_pengembalian','$status','','')");

header("location:peminjamanBuku.php?info=simpan");
