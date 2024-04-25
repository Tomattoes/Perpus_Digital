<?php
include '../../koneksi.php';

$id = $_POST['id_kt'];
$nama = $_POST['nama'];

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT KategoriID, NamaKategori FROM kategoribuku");
$data = mysqli_fetch_array($query);

if ($id == $data['KategoriID']) {
    echo "<script>
    alert('ID Kategori ini sudah digunakan, silahkan gunakan ID lain!'); window.location='kategori.php';
    </script>";
} elseif ($nama == $data['NamaKategori']) {
    echo "<script>
    alert('Nama Kategori ini sudah digunakan, silahkan gunakan Nama lain!'); window.location='kategori.php';
    </script>";
} else {
    mysqli_query($koneksi, "INSERT INTO kategoribuku VALUES ('$id','$nama')");

    header("location:kategori.php?info=simpan");
}
