<?php
session_start();

if ($_SESSION['role'] != "petugas") {
    header("location:../../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../../index.php?info=login");
}

// Mendapatkan tanggal dan waktu saat ini
$date = date('Y-m-d'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)

$id = $_GET['id'];
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
                            <h4>Form Pembayaran Denda</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="simpan_denda.php" method="post">
                            <?php
                            include '../../koneksi.php';
                            $denda = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE PeminjamanID = '$id'");
                            while ($data = mysqli_fetch_array($denda)) {
                            ?>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">ID Member</span>
                                    <input type="hidden" class="form-control" name="id" value="<?= $data["PeminjamanID"]; ?>" readonly>
                                    <input type="text" class="form-control" name="id_member" value="<?= $data["UserID"]; ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Nama Member</span>
                                    <input type="text" class="form-control" name="nama_member" value="<?= $data["NamaLengkap"]; ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Buku Yang DiPinjam</span>
                                    <input type="text" class="form-control" name="judul" value="<?= $data["Judul"]; ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Tanggal Di Kembalikan</span>
                                    <input type="text" class="form-control" name="tgl_dikembalikan" value="<?= $data["TanggalPengembalian"]; ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Besar Denda</span>
                                    <input type="text" class="form-control" name="denda" value="<?= $data["Denda"]; ?>" readonly>
                                </div>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">Jumlah Denda Yang Dibayar</span>
                                    <input type="text" class="form-control" name="jumlah_bayar">
                                </div>
                                <a href="daftarDenda.php" class="btn btn-danger text-light">Batal</a>
                                <button type="submit" class="btn btn-success" name="bayar">Bayar</button>
                            <?php } ?>
                        </form>
                    </div>
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

    <!-- JS Script -->
    <script src="../../style/js/script.js"></script>

</body>

</html>