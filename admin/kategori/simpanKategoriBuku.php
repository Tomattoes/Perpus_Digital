<?php
include '../../koneksi.php';

$kategori = $_POST['kategori'];
$buku = $_POST['buku'];

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT KategoriID, BukuID FROM kategoribuku_relasi");
$data = mysqli_fetch_array($query);

if ($kategori == $data['KategoriID'] and $buku == $data['BukuID']) {
    echo "<script>
    alert('Data ini sudah ada, silahkan masukan Data lain!'); window.location='kategori_buku.php';
    </script>";
} else {
    mysqli_query($koneksi, "INSERT INTO kategoribuku_relasi VALUES ('','$buku','$kategori')");

    header("location:kategori_buku.php?info=simpan");
}
