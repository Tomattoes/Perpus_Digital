<?php
session_start();

if ($_SESSION['role'] != "admin") {
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
                            <h4>List Of Pengembalian Buku</h4>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['info'])) {
                            if ($_GET['info'] == "simpan") {
                        ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Sukses</h5>
                                    Buku Berhasil di Pinjam
                                </div>
                            <?php } elseif ($_GET['info'] == "update") {
                            ?> <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                                    Data berhasil di update
                                </div>
                        <?php }
                        }
                        ?>
                        <form action="simpan_pengembalian.php" method="post">
                            <h3>Form Pengembalian buku</h3>
                            <?php
                            include '../../koneksi.php';
                            $data = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE PeminjamanID='$id'
                                    ");
                            while ($item = mysqli_fetch_array($data)) {
                            ?>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">ID</label>
                                        <input type="number" class="form-control" placeholder="id peminjaman" name="id_peminjaman" id="id_peminjaman" value="<?= $item["PeminjamanID"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">ID Buku</label>
                                        <input type="text" class="form-control" placeholder="id peminjaman" name="id_buku" id="id_buku" value="<?= $item["BukuID"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Judul Buku</label>
                                        <input type="text" class="form-control" placeholder="Judul Buku" name="judul" id="judul" value="<?= $item["Judul"]; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">ID Member</label>
                                        <input type="number" class="form-control" placeholder="Nisn Siswa" name="id_member" id="nisn" value="<?= $item["UserID"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Nama Member</label>
                                        <input type="text" class="form-control" placeholder="Nama Siswa" name="nama" id="nama" value=" <?= $item["NamaLengkap"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">ID Petugas</label>
                                        <input type="number" class="form-control" placeholder="Id Admin" name="id_admin" id="id_admin" value="<?= $item["PetugasID"]; ?>" readonly>
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Tanggal Buku Dipinjam</label>
                                        <input type="date" class="form-control" name="tgl_peminjaman" id="tgl_peminjaman" value="<?= $item["TanggalPeminjaman"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Tenggat Pengembalian Buku</label>
                                        <input type="date" class="form-control" name="tgl_pengembalian" id="tgl_pengembalian" value="<?= $item["TanggalPengembalian"]; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Tanggal Pengembalian Buku</label>
                                        <input type="date" class="form-control" name="buku_kembali" id="buku_kembali" value="<?= $date; ?>" readonly> <!--readonly-->
                                    </div>
                                </div>
                                <?php
                                include_once '../../function.php';
                                $denda = 1000;

                                $tanggal_dateline = $item['TanggalPengembalian'];

                                $tgl_kembali = date('Y-m-d');

                                $lambat = terlambat($tanggal_dateline, $tgl_kembali);

                                $denda1 = $lambat*$denda;

                                if ($lambat) {
                                    $keterlambatan = 'YA';
                                } else {
                                    $keterlambatan = 'TIDAK';
                                }

                                ?>
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Keterlambatan</label>
                                        <input type="text" class="form-control" name="lambat" id="lambat" value="<?= $keterlambatan; ?>" readonly>
                                    </div>
                                    <div class="col-4">
                                        <label for="exampleFormControlInput1" class="form-label">Denda</label>
                                        <input type="number" class="form-control" name="denda" id="denda" value="<?= $denda1; ?>" readonly>
                                    </div>
                                </div>
                            <?php } ?>
                            <a class="btn btn-danger" href="../peminjaman/peminjamanBuku.php"> Batal</a>
                            <button type="submit" class="btn btn-success" name="kembalikan">Kembalikan</button>
                        </form>
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