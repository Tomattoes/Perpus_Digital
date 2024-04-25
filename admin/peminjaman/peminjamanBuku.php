<?php
session_start();

if ($_SESSION['role'] != "admin") {
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
    <!-- DataTables -->
    <link rel="stylesheet" href="../../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <!-- select2 -->
    <link rel="stylesheet" href="../../assets/plugins/select2/css/select2.min.css">
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
                            <h4>Peminjaman Buku</h4>
                        </div>
                        <div class="card-tools">
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"> Tambah Data</i></button>
                            <a class="btn btn-danger btn-sm" href="../index.php"><i class="fas fa-arrow-left"> Back</i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['info']))
                            if ($_GET['info'] == "simpan") {
                        ?>
                            <div class="alert alert-success alert-dismissible">
                                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                <h5><i class="icon fas fa-check"></i> Sukses</h5>
                                Buku Berhasil di Pinjam
                            </div>
                        <?php
                            } ?>
                        <table id="example1" class="table table-bordered table-stripped">
                            <thead>
                                <tr class="text-center text-bold bg-info">
                                    <td>NO</td>
                                    <td>ID Buku</td>
                                    <td>Judul Buku</td>
                                    <td>ID Member</td>
                                    <td>Nama Member</td>
                                    <td>Petugas</td>
                                    <td>Peminjaman</td>
                                    <td>Pengembalian</td>
                                    <td>Keterlambatan</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../../koneksi.php';
                                $member = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE StatusPeminjaman='dipinjam' ORDER BY PeminjamanID DESC");
                                $no = 1;
                                while ($data = mysqli_fetch_array($member)) {
                                ?>
                                    <tr>
                                        <td><?= $no++ ?></td>
                                        <td><?= $data['BukuID']; ?></td>
                                        <td><?= $data['Judul']; ?></td>
                                        <td><?= $data['UserID']; ?></td>
                                        <td><a href="../member/detailMember.php?id=<?= $data['UserID'] ?>"><?= $data['NamaLengkap']; ?></a></td>
                                        <td><?= $data['PetugasID']; ?></td>
                                        <td><?= $data['TanggalPeminjaman']; ?></td>
                                        <td><?= $data['TanggalPengembalian']; ?></td>
                                        <td><?php
                                            $denda = 1000;
                                            include_once '../../function.php';
                                            $tanggal_dateline = $data['TanggalPengembalian'];

                                            $tgl_kembali = date('Y-m-d');

                                            $lambat = terlambat($tanggal_dateline, $tgl_kembali);

                                            $denda1 = $lambat * $denda;

                                            if ($lambat > 0) {
                                                echo "<font color='red'>$lambat hari. <br>" . number_format($denda1, 2, ',', '.') . "</font>"; 
                                            } else {
                                                echo $lambat . " hari";
                                            }

                                            ?></td>
                                        <td style="width: 155px;">
                                            <a href="../pengembalian/pengembalianBuku.php?id=<?= $data['PeminjamanID']; ?>" class="btn btn-success"><i class="fas fa-backward"></i> Kembalikan</a>
                                        </td>
                                    </tr>
                                <?php } ?>

                                <div class="modal fade" id="modal-tambah">
                                    <div class="modal-dialog">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Peminjaman</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="proses_pinjam.php" method="post">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <label for="">Pilih Member</label>
                                                        <select name="user" id="" class="form-control select2" style="width: 100%;">
                                                            <option value=""> -- Pilih Member -- </option>
                                                            <?php
                                                            include '../../koneksi.php';
                                                            $member = mysqli_query($koneksi, "SELECT * FROM user WHERE role='user' ");
                                                            while ($data = mysqli_fetch_array($member)) {
                                                            ?>
                                                                <option value="<?= $data['UserID']; ?>"><?= $data['UserID']; ?> - <?= $data['NamaLengkap']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                        <label for="">Pilih Buku</label>
                                                        <select name="buku" id="" class="form-control select2" style="width: 100%;">
                                                            <option value=""> -- Pilih Buku -- </option>
                                                            <?php
                                                            include '../../koneksi.php';
                                                            $buku = mysqli_query($koneksi, "SELECT * FROM buku");
                                                            while ($data = mysqli_fetch_array($buku)) {
                                                            ?>
                                                                <option value="<?= $data['BukuID']; ?>"><?= $data['Judul']; ?> - <?= $data['Penulis']; ?></option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="modal-footer justify-content-between">
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                    <button type="submit" class="btn btn-primary">Simpan</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
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
    <!-- DataTables  & assets/Plugins -->
    <script src="../../assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="../../assets/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../../assets/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
    <script src="../../assets/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../../assets/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
    <script src="../../assets/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="../../assets/plugins/jszip/jszip.min.js"></script>
    <script src="../../assets/plugins/pdfmake/pdfmake.min.js"></script>
    <script src="../../assets/plugins/pdfmake/vfs_fonts.js"></script>
    <script src="../../assets/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
    <script src="../../assets/plugins/datatables-buttons/js/buttons.print.min.js"></script>
    <script src="../../assets/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>
    <!-- select 2 -->
    <script src="../../assets/plugins/select2/js/select2.full.min.js"></script>
    <script>
        $(function() {
            $("#example1").DataTable({
                "responsive": true,
                "lengthChange": false,
                "autoWidth": false,
                "buttons": ["excel", "pdf", "print", "colvis"]
            }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
            $('#example2').DataTable({
                "paging": true,
                "lengthChange": false,
                "searching": false,
                "ordering": true,
                "info": true,
                "autoWidth": false,
                "responsive": true,
            });
        });
    </script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            $('.select2').select2()

            //Initialize Select2 Elements
            $('.select2bs4').select2({
                theme: 'bootstrap4'
            })
        })
    </script>
</body>

</html>