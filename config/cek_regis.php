<?php

include '../koneksi.php';


// mengambil data barang dengan kode paling besar
$query = mysqli_query($koneksi, "SELECT max(UserID) as kodeTerbesar, Email, Username FROM user");
$data = mysqli_fetch_array($query);
$kode = $data['kodeTerbesar'];

// mengambil angka dari kode  terbesar, menggunakan fungsi substr
// dan diubah ke integer dengan (int)
$urutan = (int) substr($kode, 3, 3);

// bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
$urutan++;
$huruf = "22";
$kode = $huruf . sprintf("%03s", $urutan);
$ID = $kode;
$namalengkap = $_POST['namalengkap'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = md5($_POST['password']);
$password2 = md5($_POST['password2']);
$no_hp = $_POST['no_hp'];
$alamat = $_POST['alamat'];
$role = 'user';
$tgl = $_POST['tgl_pendaftaran'];

if ($password != $password2) {
    header("location:../index.php?info=gagal_registration");
} else if ($email == $data['Email']) {
    echo "<script>
    alert('Email ini sudah digunakan, silahkan gunakan Email lain!'); window.location='index.php';
    </script>";
} else if ($username == $data['Username']) {
    echo "<script>
    alert('Username ini sudah digunakan, silahkan gunakan Username lain!'); window.location='index.php';
    </script>";
} else {
    mysqli_query($koneksi, "INSERT INTO user VALUES ('$ID','$username','$password2','$email','$namalengkap','$no_hp','$alamat','$role','$tgl')");
    header("location:../index.php?info=registration_success");
}
