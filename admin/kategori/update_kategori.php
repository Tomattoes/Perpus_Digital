<?php
include '../../koneksi.php';

$id = $_POST['id'];
$nama = $_POST['nama'];

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT KategoriID, NamaKategori FROM kategoribuku");
$data = mysqli_fetch_array($query);

if ($nama == $data['NamaKategori']) {
    echo "<script>
    alert('Nama Kategori ini sudah digunakan, silahkan gunakan Nama lain!'); window.location='kategori.php';
    </script>";
} else {
    mysqli_query($koneksi, "UPDATE kategoribuku set NamaKategori='$nama' WHERE KategoriID='$id'");

    header("location:kategori.php?info=update");
}
