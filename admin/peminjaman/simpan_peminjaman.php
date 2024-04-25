<?php
include '../../koneksi.php';

$buku = $_POST['buku'];
$member = $_POST['member'];
$petugas = $_POST['id_petugas'];
$tgl_peminjaman = $_POST['tgl_peminjaman'];
$tgl_pengembalian = $_POST['tgl_pengembalian'];
$status = 'dipinjam';

// cek stok buku
$query = $koneksi->query("SELECT * FROM buku WHERE BukuID = '$buku'");
while ($hasil = $query->fetch_assoc()) {
    $sisa = $hasil['stok'];

    //cek data yang duplikate
    $cek = $koneksi->query("SELECT * FROM peminjaman WHERE UserID=$member AND BukuID=$buku AND StatusPeminjaman='dipinjam' ");
    $num1 = mysqli_num_rows($cek);

    if ($sisa == 0) {
        echo "<script>alert('Stok buku telah habis, tidak dapat melakukan peminjaman'); window.location.assign('peminjamanBuku.php');</script>";
    } elseif (!$num1) {
        $q1 = $koneksi->query("INSERT INTO peminjaman VALUES ('','$member','$buku','$petugas','$tgl_peminjaman','$tgl_pengembalian','$status','','')");
        $q2 = $koneksi->query("UPDATE buku SET stok=(stok-1) WHERE BukuID='$buku'");

        header("location:peminjamanBuku.php?info=simpan");
    } else {
        echo "<script>alert('Anda sudah meminjam buku yang sama'); window.location.assign('peminjamanBuku.php');</script>";
    }
}
