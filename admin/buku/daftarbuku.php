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
                            <h4>Buku</h4>
                        </div>
                        <div class="card-tools">
                            <a href="../kategori/kategori.php" class="btn btn-info btn-sm"><i class="fas fa-list"></i> Lihat Daftar Kategori</a>
                            <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"> Tambah Buku</i></button>
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
                                    Data berhasil di hapus
                                </div>
                            <?php } elseif ($_GET['info'] == "simpan") {
                            ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Sukses</h5>
                                    Data berhasil di simpan
                                </div>
                            <?php } elseif ($_GET['info'] == "update") {
                            ?> <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-edit"></i> Sukses</h5>
                                    Data berhasil di update
                                </div>
                        <?php }
                        } ?>
                        <table class="table table-bordered" id="example1">
                            <thead>
                                <tr class="text-center text-bold bg-success">
                                    <td style="width: 20px;">NO</td>
                                    <td style="width: 120px;">ID Buku</td>
                                    <td>Judul Buku</td>
                                    <td>Penulis</td>
                                    <td>Penerbit</td>
                                    <td>Tahun Terbit</td>
                                    <td>Rak</td>
                                    <td>Stok</td>
                                    <td>Aksi</td>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../../koneksi.php';
                                if (isset($_POST['search'])) {
                                    $keyword = $_POST['keyword'];
                                    $member = mysqli_query($koneksi, "SELECT * FROM buku WHERE
                                    BukuID LIKE '%$keyword%' OR
                                    Judul LIKE '%$keyword%' OR
                                    Penulis LIKE '%$keyword%' OR
                                    Penerbit LIKE '%$keyword%' OR
                                    TahunTerbit LIKE '%$keyword%' 
                                    ");
                                } else {
                                    $member = mysqli_query($koneksi, "SELECT * FROM buku");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_array($member)) {
                                ?>
                                    <tr>
                                        <td><?= $no++; ?></td>
                                        <td><?= $data['BukuID']; ?></td>
                                        <td><a href="detailBuku.php?id=<?= $data['BukuID']; ?>"><?= $data['Judul']; ?></a></td>
                                        <td><?= $data['Penulis']; ?></td>
                                        <td><?= $data['Penerbit']; ?></td>
                                        <td><?= $data['TahunTerbit']; ?></td>
                                        <td><?= $data['LokasiRak']; ?></td>
                                        <td><?= $data['stok']; ?></td>
                                        <td style="width: 200px;">
                                            <button class="btn btn-warning" data-toggle="modal" data-target="#modal-edit<?= $data['BukuID']; ?>"><i class="fas fa-edit"></i> Edit </button>
                                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?= $data['BukuID']; ?>"><i class="fas fa-trash"></i> Hapus </button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-hapus<?= $data['BukuID']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Hapus Data Buku</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="">
                                                    <div class="modal-body">
                                                        <p>Apakah anda yakin akan menghapus Data Buku <b><?= $data['Judul']; ?></b> ini ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <a href="hapus_buku.php?id=<?= $data['BukuID']; ?>" class="btn btn-primary">Hapus</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-edit<?= $data['BukuID']; ?>">
                                        <div class="modal-dialog modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Edit Data Buku</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="update_buku.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <img src="../../assets/img/<?= $data['foto']; ?>" alt="" width="120px" height="160px">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="form-group">
                                                                    <input type="hidden" name="fileLama" class="form-control" placeholder="Masukkan Cover" required value="<?= $data['foto']; ?>">
                                                                    <label for="">Cover Buku</label>
                                                                    <input type="file" name="file" class="form-control" placeholder="Masukkan Cover" required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Judul Buku</label>
                                                                    <input type="hidden" name="id" value="<?= $data['BukuID']; ?>">
                                                                    <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" required value="<?= $data['Judul']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Jumlah Halaman</label>
                                                                    <input type="number" name="jumlah_halaman" class="form-control" placeholder="Masukkan Jumlah Halaman" required value="<?= $data['jumlah_halaman']; ?>"></input>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Stok Buku</label>
                                                                    <input type="number" name="stok" class="form-control" placeholder="Masukkan Jumlah Buku" required value="<?= $data['stok']; ?>"></input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Penulis</label>
                                                                    <input type="text" name="penulis" class="form-control" placeholder="Masukkan Penulis" required value="<?= $data['Penulis']; ?>">
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Penerbit</label>
                                                                    <input type="text" name="penerbit" class="form-control" placeholder="Masukkan Penerbit" required value="<?= $data['Penerbit']; ?>"></input>
                                                                </div>
                                                            </div>
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Tahun Terbit</label>
                                                                    <input type="text" maxlength="4" name="tahun_terbit" class="form-control" placeholder="Masukkan Tahun Terbit" required value="<?= $data['TahunTerbit']; ?>"></input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-4">
                                                                <div class="form-group">
                                                                    <label for="">Rak</label>
                                                                    <input type="text" name="rak" class="form-control" placeholder="Masukkan Lokasi Rak" required value="<?= $data['LokasiRak']; ?>"></input>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                                                        <button type="submit" class="btn btn-primary">Update</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>

                                <div class="modal fade" id="modal-tambah">
                                    <div class="modal-dialog modal-xl">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h4 class="modal-title">Tambah Data Buku</h4>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>

                                            <form action="simpan_buku.php" method="post" enctype="multipart/form-data">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Cover Buku</label>
                                                                <input type="file" name="file" class="form-control" placeholder="Masukkan Cover" required>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Judul Buku</label>
                                                                <input type="text" name="judul" class="form-control" placeholder="Masukkan Judul Buku" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Jumlah Halaman</label>
                                                                <input type="number" name="jumlah_halaman" class="form-control" placeholder="Masukkan Jumlah Halaman" required></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Stok Buku</label>
                                                                <input type="number" name="stok" class="form-control" placeholder="Masukkan Jumlah Buku" required></input>
                                                            </div>
                                                        </div>
                                                        <!-- <div class="col-6">
                                                            <div class="form-group">
                                                                <label for="">Cover Buku</label>
                                                                <input type="file" name="cover" class="form-control" placeholder="Masukkan Cover Buku" required>
                                                            </div>
                                                        </div> -->
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Penulis</label>
                                                                <input type="text" name="penulis" class="form-control" placeholder="Masukkan Penulis" required>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Penerbit</label>
                                                                <input type="text" name="penerbit" class="form-control" placeholder="Masukkan Penerbit" required></input>
                                                            </div>
                                                        </div>
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Tahun Terbit</label>
                                                                <input type="text" maxlength="4" name="tahun_terbit" class="form-control" placeholder="Masukkan Tahun Terbit" required></input>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-4">
                                                            <div class="form-group">
                                                                <label for="">Rak</label>
                                                                <input type="text" name="rak" class="form-control" placeholder="Masukkan Lokasi Rak" required></input>
                                                            </div>
                                                        </div>
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
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>
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