<?php
session_start();

if ($_SESSION['role'] != "admin") {
    header("location:../../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../../index.php?info=login");
}

// Mendapatkan tanggal dan waktu saat ini
$date = date('Y-m-d'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
$BukuID = $_GET['id'];
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
                            <h4>Detail Buku</h4>
                        </div>
                        <div class="card-tools">
                            <a class="btn btn-danger btn-sm" href="daftarBuku.php"><i class="fas fa-arrow-left"> Back</i></a>
                        </div>
                    </div>

                    <form class="form-horizontal">
                        <div class="card-body">
                            <?php
                            include '../../koneksi.php';
                            $buku = mysqli_query($koneksi, "SELECT * FROM buku WHERE BukuID='$BukuID' ");
                            while ($data = mysqli_fetch_array($buku)) {
                            ?>
                                <div class="text-center mb-3">
                                    <img src="../../assets/img/<?= $data['foto']; ?>" alt="" class="card-img-top justify-content-center" style="width: 120px;">
                                </div>
                                <div class="form-group row">
                                    <label for="inputEmail3" class="col-sm-2 col-form-label">ID Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="<?= $data['BukuID']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Judul Buku</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Judul']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Penulis</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Penulis']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Penerbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Penerbit']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Tahun Terbit</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['TahunTerbit']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Jumlah Halaman</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['jumlah_halaman']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Stok</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['stok']; ?>/<?= $data['JumlahBuku']; ?>" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="inputPassword3" class="col-sm-2 col-form-label">Lokasi Rak</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['LokasiRak']; ?>" readonly>
                                    </div>
                                </div>
                        </div>
                    <?php } ?>
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
    <script src="../../assets/dist/js/demo.js"></script> <!-- DataTables  & assets/Plugins -->
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