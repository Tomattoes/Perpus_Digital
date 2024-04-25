<?php
session_start();

if ($_SESSION['role'] != "user") {
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
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css" />

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
                            <h4>List Of Buku</h4>
                        </div>
                        <div class="card-tools">
                            <!-- <button class="btn btn-primary btn-sm" data-toggle="modal" data-target="#modal-tambah"><i class="fas fa-plus"> Tambah Buku</i></button> -->
                            <a class="btn btn-danger btn-sm" href="../index.php"><i class="fas fa-arrow-left"> Back</i></a>
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
                                    Buku Berhasil Ditambahkan Ke Favorit!
                                </div>
                            <?php } elseif ($_GET['info'] == "sukses") {
                            ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                                    <h5><i class="icon fas fa-check"></i> Terima Kasih!</h5>
                                    Ulasan Anda Telah Terkirim.
                                </div>
                        <?php }
                        } ?>
                        <table id="myTable" class="table table-striped table-bordered data">
                            <!--search engine --->
                            <form action="" method="post" class="mt-5">
                                <div class="input-group d-flex justify-content-around mb-3">
                                    <div>
                                        <input class="border p-2 rounded rounded-end-0 bg-tertiary" type="text" name="keyword" id="keyword" placeholder="cari data buku...">
                                        <button class="border border-start-0 bg-light rounded rounded-start-0" type="submit" name="search"><i class="fas fa-solid fa-search"></i></button>
                                    </div>
                                </div>
                            </form>

                            <thead>
                                <tr class="text-center text-bold bg-success">
                                    <td>Judul Buku</td>
                                    <td>Kategori</td>
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
                                    FROM kategoribuku_relasi INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID INNER JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID WHERE
                                    buku.BukuID LIKE '%$keyword%' OR
                                    Judul LIKE '%$keyword%' OR
                                    Penulis LIKE '%$keyword%' OR
                                    Penerbit LIKE '%$keyword%' OR
                                    NamaKategori LIKE '%$keyword%' OR
                                    TahunTerbit LIKE '%$keyword%' 
                                    ");
                                } else {
                                    $member = mysqli_query($koneksi, "SELECT * 
                                    FROM kategoribuku_relasi INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID INNER JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID");
                                }
                                $no = 1;
                                while ($data = mysqli_fetch_array($member)) {
                                ?>
                                    <tr>
                                        <td><?= $data['Judul']; ?></td>
                                        <td><?= $data['NamaKategori']; ?></td>
                                        <td><?= $data['Penulis']; ?></td>
                                        <td><?= $data['Penerbit']; ?></td>
                                        <td><?= $data['TahunTerbit']; ?></td>
                                        <td><?= $data['jumlah_halaman']; ?></td>
                                        <td>
                                            <a href="daftarBuku.php" onclick="return confirm('Temui Petugas Di Kasir Untuk Meminjam Buku!');" class="btn btn-info btn-sm"><i class="fas fa-book"></i> Pinjam Buku</a>
                                            <button class="btn btn-warning btn-sm text-white" data-toggle="modal" data-target="#modal-tambah<?= $data['BukuID']; ?>"><i class="fas fa-plus"></i> Tambah Ke Favorit</button>
                                            <button class="btn btn-success btn-sm text-white" data-toggle="modal" data-target="#modal-ulasan<?= $data['BukuID']; ?>"><i class="fas fa-solid fa-pen"></i> Beri Ulasan</button>
                                        </td>
                                    </tr>

                                    <div class="modal fade" id="modal-tambah<?= $data['BukuID']; ?>">
                                        <div class="modal-dialog">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Tambah Buku Ke Favorit</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="">
                                                    <div class="modal-body">
                                                        <p>Apakah anda ingin menambah Buku <b><?= $data['Judul']; ?></b> ke Favorit ... ?</p>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Tidak</button>
                                                        <a href="tambah_favorit.php?id=<?= $data['BukuID']; ?>&id_user=<?= $_SESSION['UserID']; ?>" class="btn btn-primary">Ya</a>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="modal fade" id="modal-ulasan<?= $data['BukuID']; ?>">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h4 class="modal-title">Beri Ulasan Untuk Buku <b><?= $data['Judul']; ?> - <?= $data['Penulis']; ?></b></h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>

                                                <form action="simpan_ulasan.php" method="post">
                                                    <div class="modal-body">
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <input type="hidden" name="id" value="<?= $_SESSION['UserID']; ?>">
                                                                <input type="hidden" name="idBuku" value="<?= $data['BukuID']; ?>">
                                                                <input type="text" class="form-control" readonly value="<?= $_SESSION['UserID']; ?> - <?= $_SESSION['NamaLengkap']; ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-6">
                                                            <label>Rating</label><br>
                                                            <div class="d-flex justify-content-around">
                                                                <div><input type="radio" name="rating" id="1" value="1"></input>
                                                                    <label for="1">1</label>
                                                                </div>
                                                                <div><input type="radio" name="rating" id="2" value="2"></input>
                                                                    <label for="2">2</label>
                                                                </div>
                                                                <div><input type="radio" name="rating" id="3" value="3"></input>
                                                                    <label for="3">3</label>
                                                                </div>
                                                                <div><input type="radio" name="rating" id="4" value="4"></input>
                                                                    <label for="4">4</label>
                                                                </div>
                                                                <div><input type="radio" name="rating" id="5" value="5"></input>
                                                                    <label for="5">5</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col">
                                                            <div class="form-group">
                                                                <label for="">Ulasan</label>
                                                                <textarea type="text" name="ulasan" class="form-control" placeholder="Tulis Ulasan ..." required></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer justify-content-between">
                                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                                                        <button type="submit" class="btn btn-success">Kirim</button>
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
    <!-- Bootstrap 4 -->
    <script src="../../assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="../../assets/dist/js/adminlte.min.js"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="../../assets/dist/js/demo.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>

</body>

</html>