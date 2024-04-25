<?php
session_start();

if ($_SESSION['role'] != "petugas") {
    header("location:../../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../../index.php?info=login");
}

// Mendapatkan tanggal dan waktu saat ini
$date = date('Y-m-d'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
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
                            <h4>List Of Denda</h4>
                        </div>
                        <div class="card-tools"><a class="btn btn-danger btn-sm" href="../index.php"><i class="fas fa-arrow-left"> Back</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['info'])) {
                            if ($_GET['info'] == "sukses") {
                        ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Sukses</h5>
                                    Denda Telah Di Bayar!
                                </div>
                        <?php }
                        } ?>
                        <table class="table table-bordered">
                            <!--search engine --->
                            <form action="" method="post" class="mt-5">
                                <div class="input-group d-flex justify-content-around mb-3">
                                    <div>
                                        <button class="btn btn-danger"><i class="fas fa-file-pdf"></i> PDF</button>
                                        <button class="btn btn-success"><i class="fas fa-file-excel"></i> Excel</button>
                                        <button class="btn btn-info"><i class="fas fa-print"></i> Print</button>
                                    </div>
                                    <div>
                                        <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari data ...">
                                        <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fas fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <thead>
                                <tr class="text-center text-bold bg-danger">
                                    <td style="width: 60px;">ID</td>
                                    <td>ID Buku</td>
                                    <td>Judul Buku</td>
                                    <td>ID Member</td>
                                    <td>Nama Member</td>
                                    <td>Email</td>
                                    <td>Tlp</td>
                                    <td>ID Petugas</td>
                                    <td>Pengembalian</td>
                                    <td>Keterlambatan</td>
                                    <td>Denda</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../../koneksi.php';
                                if (isset($_POST['search'])) {
                                    $keyword = $_POST['keyword'];
                                    $member = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE
                                   NamaLengkap LIKE '%$keyword%' OR
                                    Judul LIKE '%$keyword%' OR
                                    Email LIKE '%$keyword%' OR
                                    BukuID LIKE '%$keyword%' OR
                                    UserID LIKE '%$keyword%' OR
                                    No_HP LIKE '%$keyword%' OR
                                    TanggalPeminjaman LIKE '%$keyword%' OR
                                    TanggalPengembalian LIKE '%$keyword%' OR
                                    PetugasID LIKE '%$keyword%' AND Denda > 0
                                    ");
                                } else {
                                    $member = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE Denda > 0");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_array($member)) {
                                ?>
                                    <tr>
                                        <td><?= $data['PeminjamanID']; ?></td>
                                        <td><?= $data['BukuID']; ?></td>
                                        <td><?= $data['Judul']; ?></td>
                                        <td><?= $data['UserID']; ?></td>
                                        <td><?= $data['NamaLengkap']; ?></td>
                                        <td><?= $data['Email']; ?></td>
                                        <td><?= $data['No_HP']; ?></td>
                                        <td><?= $data['PetugasID']; ?></td>
                                        <td><?= $data['TanggalPengembalian']; ?></td>
                                        <td><?= $data['Keterlambatan']; ?></td>
                                        <td><?= $data['Denda']; ?></td>
                                        <td>
                                            <a href="formBayarDenda.php?id=<?= $data['PeminjamanID']; ?>" class="btn btn-success"><i class="fas fa-cash"></i> Bayar</a>
                                        </td>
                                    </tr>
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