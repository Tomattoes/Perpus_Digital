<?php
include '../../koneksi.php';

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(BukuID) as kodeTerbesar FROM buku");
$data = mysqli_fetch_array($query);
$kode = $data['kodeTerbesar'];

// mengambil angka dari kode  terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kode, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
$huruf = "30";
$kode = $huruf . sprintf("%03s", $urutan);
$ID = $kode;

$cover = upload();
$judul = $_POST['judul'];
$penulis = $_POST['penulis'];
$penerbit = $_POST['penerbit'];
$tahun_terbit = $_POST['tahun_terbit'];
$jumlah_halaman = $_POST['jumlah_halaman'];
$rak = $_POST['rak'];
$stok = $_POST['stok'];

// upload
function upload()
{
    $ekstensi_diperbolehkan  = array('png', 'jpg', 'jpeg');
    $nama = $_FILES['file']['name'];
    $x = explode('.', $nama);
    $ekstensi = strtolower(end($x));
    $ukuran  = $_FILES['file']['size'];
    $file_tmp = $_FILES['file']['tmp_name'];

    if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
        if ($ukuran < 1044070) {
            move_uploaded_file($file_tmp, '../../assets/img/' . $nama);
            return $nama;
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
}

// $namaFile = $_FILES["cover"]["name"];
// $ukuranFile = $_FILES["cover"]["size"];
// $error = $_FILES["cover"]["error"];
// $tmpName = $_FILES["cover"]["tmp_name"];

// // cek apakah ada gambar yg diupload
// if ($error === 4) {
//     echo "<script>
//       alert('Silahkan upload cover buku terlebih dahulu!')
//       </script>";
//     return 0;
// }

// // cek kesesuaian format gambar
// $jpg = "jpg";
// $jpeg = "jpeg";
// $png = "png";
// $svg = "svg";
// $bmp = "bmp";
// $psd = "psd";
// $tiff = "tiff";
// $formatGambarValid = [$jpg, $jpeg, $png, $svg, $bmp, $psd, $tiff];
// $ekstensiGambar = explode('.', $namaFile);
// $ekstensiGambar = strtolower(end($ekstensiGambar));

// if (!in_array($ekstensiGambar, $formatGambarValid)) {
//     echo "<script>
//   alert('Format file tidak sesuai');
//   </script>";
//     return 0;
// }

// // batas ukuran file
// if ($ukuranFile < 1044070) {
//     echo "<script>
//   alert('Ukuran file terlalu besar!');
//   </script>";
//     return 0;
// }

//     //generate nama file baru, agar nama file tdk ada yg sama
// $namaFileBaru = uniqid();
// $namaFileBaru = ".";
// $namaFileBaru = $ekstensiGambar;

// move_uploaded_file($tmpName, '../../assets/img/' . $namaFile);
// return $namaFile;
// }

// if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
//     if ($ukuran < 1044070) {
//         move_uploaded_file($file_tmp, '../../assets/img/' . $nama);
//         $query = mysqli_query($koneksi, "INSERT INTO buku VALUES ('$ID','$judul','$penulis','$penerbit','$tahun_terbit','$jumlah_halaman','$rak','$stok','$stok')");
//         if ($query) {
//             echo 'FILE BERHASIL DI UPLOAD';
//         } else {
//             echo 'GAGAL MENGUPLOAD GAMBAR';
//         }
//     } else {
//         echo 'UKURAN FILE TERLALU BESAR';
//     }
// } else {
//     echo 'EKSTENSI FILE YANG DI UPLOAD TIDAK DI PERBOLEHKAN';
// }

// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT Judul FROM buku");
$data = mysqli_fetch_array($query);

if (!isset($data['Judul'])) {
    mysqli_query($koneksi, "INSERT INTO buku VALUES ('$ID','$judul','$penulis','$penerbit','$tahun_terbit','$jumlah_halaman','$rak','$stok','$stok','$cover')");

    header("location:daftarbuku.php?info=simpan");
} else
if ($judul == $data['Judul']) {
    echo "<script>
    alert('Judul Buku ini sudah digunakan, silahkan gunakan Judul lain!'); window.location.assign('daftarbuku.php');
    </script>";
} else {
    mysqli_query($koneksi, "INSERT INTO buku VALUES ('$ID','$judul','$penulis','$penerbit','$tahun_terbit','$jumlah_halaman','$rak','$stok','$stok','$cover')");

    header("location:daftarbuku.php?info=simpan");
}
