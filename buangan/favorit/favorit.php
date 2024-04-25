<?php
session_start();

if ($_SESSION['role'] != "user") {
    header("location:../../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../../index.php?info=login");
}

// Mendapatkan tanggal dan waktu saat ini
$date = date('Y-m-d'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)

$id = $_SESSION['UserID'];
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
                <div class="card">
                    <div class="card-header">
                        <div class="card-title">
                            <h4>Favorit</h4>
                        </div>
                        <div class="card-tools">
                            <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"> Tambah Buku</i></button> -->
                            <a class="btn btn-danger btn-sm" href="../index.php"><i class="fas fa-arrow-left"> Back</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['info'])) {
                            if ($_GET['info'] == "hapus") {
                        ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-trash"></i> Sukses</h5>
                                    Buu Telah Berhasil Di Un-Favorit!
                                </div>
                        <?php }
                        } ?>
                        <table class="table table-bordered">
                            <thead>
                                <tr class="text-center text-bold bg-warning">
                                    <td>Judul Buku</td>
                                    <td>Penulis</td>
                                    <td>Penerbit</td>
                                    <td>Tahun Terbit</td>
                                    <td>Jumlah Halaman</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../../koneksi.php';
                                if (isset($_POST['search'])) {
                                    $keyword = $_POST['keyword'];
                                    $member = mysqli_query($koneksi, "SELECT * 
                                    FROM koleksipribadi INNER JOIN user ON koleksipribadi.UserID = user.UserID INNER JOIN buku ON koleksipribadi.BukuID = buku.BukuID WHERE user.UserID='$id' AND
                                    buku.BukuID LIKE '%$keyword%' OR
                                    Judul LIKE '%$keyword%' OR
                                    Penulis LIKE '%$keyword%' OR
                                    Penerbit LIKE '%$keyword%' OR
                                    NamaKategori LIKE '%$keyword%' OR
                                    TahunTerbit LIKE '%$keyword%' 
                                    ");
                                } else {
                                    $member = mysqli_query($koneksi, "SELECT * 
                                    FROM koleksipribadi INNER JOIN user ON koleksipribadi.UserID = user.UserID INNER JOIN buku ON koleksipribadi.BukuID = buku.BukuID WHERE user.UserID='$id'");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_array($member)) {
                                ?>
                                    <tr>
                                        <td><?= $data['Judul']; ?></td>
                                        <td><?= $data['Penulis']; ?></td>
                                        <td><?= $data['Penerbit']; ?></td>
                                        <td><?= $data['TahunTerbit']; ?></td>
                                        <td><?= $data['jumlah_halaman']; ?></td>
                                        <td>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $data['KoleksiID']; ?>"><i class="fas fa-arrow-left"></i> Batalkan Favorit </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-hapus<?= $data['KoleksiID']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Batalkan Favorit</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="">
                                                    <div class="modal-body">
                                                        <p>Apakah anda ingin meng un-favorit Buku <b><?= $data['Judul']; ?></b> ini ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                                                        <a href="hapus_favorit.php?id=<?= $data['KoleksiID']; ?>" class="btn btn-primary">Ya</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                <?php } ?>

                            </tbody>
                        </table>
                    </div>
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
</body>

</html>