<?php
session_start();

include '../koneksi.php';

$username = $_POST['username'];
$password = md5($_POST['password']);

$login = mysqli_query($koneksi, "SELECT * FROM user WHERE Username='$username' AND Password='$password' ");
$cek = mysqli_num_rows($login);

if ($cek > 0) {
    $data = mysqli_fetch_assoc($login);
    if ($data['role'] == "admin") {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
        $_SESSION['role'] = "admin";
        $_SESSION['UserID'] = $data['UserID'];
        header("location:../admin");
    } else if ($data['role'] == "petugas") {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
        $_SESSION['role'] = "petugas";
        $_SESSION['UserID'] = $data['UserID'];
        header("location:../petugas");
    } else if ($data['role'] == "user") {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        $_SESSION['NamaLengkap'] = $data['NamaLengkap'];
        $_SESSION['Email'] = $data['Email'];
        $_SESSION['UserID'] = $data['UserID'];
        $_SESSION['role'] = "user";
        header("location:../user");
    } else {
        header("location:../index.php?info=gagal");
    }
} else {
    header("location:../index.php?info=gagal");
}
