<?php

include '../../koneksi.php';

$PeminjamanID = $_POST["id_peminjaman"];
$BukuID = $_POST["id_buku"];
$Judul = $_POST["judul"];
$UserID = $_POST["id_member"];
$NamaLengkap = $_POST["nama"];
$PetugasID = $_POST["id_admin"];
$TanggalPeminjaman = $_POST["tgl_peminjaman"];
$TanggalPengembalian = $_POST["tgl_pengembalian"];
$bukuKembali = $_POST["buku_kembali"];
$Status = 'dikembalikan';
$keterlambatan = $_POST["keterlambatan"];
$denda = $_POST["denda"];

if ($bukuKembali > $TanggalPengembalian) {
  echo "<script>alert('Anda terlambat mengembalikan buku, harap bayar denda sesuai dengan jumlah yang ditentukan!');</script>";
}

mysqli_query($koneksi, "UPDATE peminjaman SET TanggalPengembalian='$bukuKembali', StatusPeminjaman='$Status', Keterlambatan='$keterlambatan', Denda='$denda' WHERE PeminjamanID='$PeminjamanID'");

header("location:pengembalian.php?info=update");
