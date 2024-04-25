<?php
include '../../koneksi.php';

$id = $_POST['id'];
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$jumlah_halaman = $_POST['jumlah_halaman'];
$rak = $_POST['rak'];
$stok = $_POST['stok'];
$nama = $_FILES['file']['name'];

if ($nama != "") {
    $ekstensi_diperbolehkan  = array('png', 'jpg', 'jpeg');
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran  = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];
    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, '../../assets/img/' . $nama);
            $query =  "UPDATE buku set Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahun_terbit', jumlah_halaman='$jumlah_halaman', LokasiRak='$rak', stok='$stok', foto='$nama' WHERE BukuID='$id'";
            $result = mysqli_query($koneksi, $query);
            header("location:daftarbuku.php?info=update");
        } else {
            echo "<script>
                  alert('Ukuran file terlalu besar!')
                  </script>";
        }
    } else {
        echo "<script>
                  alert('Format gambar tidak sesuai!')
                  </script>";
    }
} else {
    $query =  "UPDATE buku set Judul='$judul', Penulis='$penulis', Penerbit='$penerbit', TahunTerbit='$tahun_terbit', jumlah_halaman='$jumlah_halaman', LokasiRak='$rak', stok='$stok' WHERE BukuID='$id'";
    $result = mysqli_query($koneksi, $query);
    header("location:daftarbuku.php?info=update");
}
