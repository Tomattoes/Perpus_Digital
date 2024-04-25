<?php
session_start();

if ($_SESSION['role'] != "admin") {
    header("location:../../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../../index.php?info=login");
}

$pinjam = date("Y-m-d");
$tuju_hari = mktime(0, 0, 0, date("n"), date("j") + 7, date("Y"));
$kembali = date("Y-m-d", $tuju_hari);

$id = $_POST['buku'];
$UserID = $_POST['user'];
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Digital</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="../../assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition layout-top-nav">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
            <div class="container">
                <a href="#" class="navbar-brand">
                    <img src="../../assets/dist/img/AdminLTELogo.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
                    <span class="brand-text font-weight-light"><b>Perpus Digital</b></span>
                </a>

                <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse order-3" id="navbarCollapse">
                    <!-- Left navbar links -->
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <a href="../index.php" class="nav-link">Home</a>
                        </li>
                    </ul>
                </div>

                <!-- Right navbar links -->
                <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
                    <li class="nav-item">
                        <a href="../../logout.php" class="nav-link" onclick="return confirm('Apakah Anda Yakin Ingin Log Out ?')">
                            <i class="fas fa-user"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </nav>
        <!-- /.navbar -->

        <div class="content-wrapper">
            <div class="container-fluid p-4">
                <div class="row">
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Data Buku</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?php
                                    include '../../koneksi.php';
                                    $buku = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID INNER JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID WHERE buku.BukuID = '$id'");
                                    while ($data = mysqli_fetch_array($buku)) {
                                    ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Id Buku</span>
                                            <input type="text" class="form-control" placeholder="id buku" aria-label="Username" aria-describedby="basic-addon1" value="<?= $data["BukuID"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Kategori</span>
                                            <input type="text" class="form-control" placeholder="kategori" aria-label="kategori" aria-describedby="basic-addon1" value="<?= $data["NamaKategori"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Judul</span>
                                            <input type="text" class="form-control" placeholder="judul" aria-label="judul" aria-describedby="basic-addon1" value="<?= $data["Judul"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Pengarang</span>
                                            <input type="text" class="form-control" placeholder="pengarang" aria-label="pengarang" aria-describedby="basic-addon1" value="<?= $data["Penulis"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Penerbit</span>
                                            <input type="text" class="form-control" placeholder="penerbit" aria-label="penerbit" aria-describedby="basic-addon1" value="<?= $data["Penerbit"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Tahun Terbit</span>
                                            <input type="text" class="form-control" placeholder="tahun_terbit" aria-label="tahun_terbit" aria-describedby="basic-addon1" value="<?= $data["TahunTerbit"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Jumlah Halaman</span>
                                            <input type="number" class="form-control" placeholder="jumlah halaman" aria-label="jumlah halaman" aria-describedby="basic-addon1" value="<?= $data["jumlah_halaman"]; ?>" readonly>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="card">
                            <div class="card-header">
                                <h3>Data Peminjam</h3>
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <?php
                                    include '../../koneksi.php';
                                    $buku = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID = '$UserID'");
                                    while ($data = mysqli_fetch_array($buku)) {
                                    ?>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">User ID</span>
                                            <input type="number" class="form-control" value="<?= $data["UserID"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Email</span>
                                            <input type="text" class="form-control" value="<?= $data["Email"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Nama</span>
                                            <input type="text" class="form-control" value="<?= $data["NamaLengkap"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">No Tlp</span>
                                            <input type="no_tlp" class="form-control" value="<?= $data["No_HP"]; ?>" readonly>
                                        </div>
                                        <div class="input-group mb-3">
                                            <span class="input-group-text" id="basic-addon1">Alamat</span>
                                            <input type="text" class="form-control" value="<?= $data["Alamat"]; ?>" readonly>
                                        </div>
                                    <?php } ?>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-danger mt-4" role="alert">Silahkan periksa kembali data diatas, pastikan sudah benar sebelum meminjam buku!. jika ada kesalahan data harap hubungi admin</div>

                <div class="card">
                    <div class="card-header">
                        <h3>Form Pinjam Buku</h3>
                    </div>
                    <div class="card-body">
                        <form action="simpan_peminjaman.php" method="post">
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Buku ID</span>
                                <input type="number" name="buku" class="form-control" value="<?= $id; ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Member ID</span>
                                <input type="text" name="member" class="form-control" value="<?= $UserID; ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Petugas</span>
                                <input type="hidden" name="id_petugas" class="form-control" value="<?= $_SESSION["UserID"]; ?>" readonly>
                                <input type="text" name="petugas" class="form-control" value="<?= $_SESSION["NamaLengkap"]; ?>" readonly>
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tanggal Pinjam</span>
                                <input type="date" class="form-control" name="tgl_peminjaman" id="tgl_peminjaman">
                            </div>
                            <div class="input-group mb-3">
                                <span class="input-group-text" id="basic-addon1">Tenggat Pengembalian</span>
                                <input type="date" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian">
                            </div>
                            <div class="mt-2">
                                <a class="btn btn-danger" href="peminjamanBuku.php"> Batal</a>
                                <button type="submit" class="btn btn-success">Pinjam</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="alert alert-danger mt-4" role="alert"><span class="fw-bold">Catatan :</span> Setiap keterlambatan pada pengembalian buku akan dikenakan sanksi berupa denda.</div>

            </div>
        </div>
    </div>

    <!-- Main Footer -->
    <footer class="main-footer justify-content-between d-flex">
        <!-- Default to the left -->
        <p><strong>Copyright &copy; 2023 <a href="">Perpus Digital</a>.</strong> All rights reserved.</p>
        <strong>V. 1.0</strong>
    </footer>
    </div>

    <!-- REQUIRED SCRIPTS -->

    <!-- jQuery -->
    <script src="../../assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>

    <!-- JS Script -->
    <script src="../../style/js/script.js"></script>

</body>

</html>