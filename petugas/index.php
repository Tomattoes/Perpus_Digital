<?php
include '../layout/header_petugas.php';
include '../layout/navbar.php';
?>
<div class="content-wrapper">
    <?php
    // Mendapatkan tanggal dan waktu saat ini
    $date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
    // Mendapatkan hari dalam format teks (e.g., Senin, Selasa, ...)
    $day = date('l');
    // Mendapatkan tanggal dalam format 1 hingga 31
    $dayOfMonth = date('d');
    // Mendapatkan bulan dalam format teks (e.g., Januari, Februari, ...)
    $month = date('F');
    // Mendapatkan tahun dalam format 4 digit (e.g., 2023)
    $year = date('Y');
    ?>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0"> Dashboard - <span class="text-lg text-secondary"><?php echo $day . " " . $dayOfMonth . " " . " " . $month . " " . $year; ?></span></h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <!-- <div class="card-header">
                            <h5 class="card-title m-0">Featured</h5>
                        </div> -->
                        <div class="card-body">
                            <h6 class="card-title">Selamat Datang <b><?php echo $_SESSION['role'], ' - ',  $_SESSION['NamaLengkap'] ?></b> Di Halaman Petugas<b> Perpus Digital </b>!</h6>
                        </div>
                    </div>
                </div>
                <!-- /.col-md-6 -->
            </div>
            <!-- /.row -->

            <div class="mt-4 p-3">
                <div class="row">
                    <div class="col-lg-6 col-12">
                        <div class="cardImg">
                            <a href="member/member.php">
                                <img src="../assets/dashboardCardMember/member1.png" alt="daftar buku" style="max-width: 100%;" width="600px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="cardImg">
                            <a href="buku/daftarBuku.php">
                                <img src="../assets/dashboardCardMember/buku.png" alt="daftar buku" style="max-width: 100%;" width="600px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="cardImg">
                            <a href="peminjaman/peminjamanBuku.php">
                                <img src="../assets/dashboardCardMember/peminjaman1.png" alt="daftar buku" style="max-width: 100%;" width="600px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="cardImg">
                            <a href="pengembalian/pengembalian.php">
                                <img src="../assets/dashboardCardMember/pengembalian.png" alt="daftar buku" style="max-width: 100%;" width="600px">
                            </a>
                        </div>
                    </div>
                    <div class="col-lg-6 col-12">
                        <div class="cardImg">
                            <a href="denda/daftarDenda.php">
                                <img src="../assets/dashboardCardMember/denda1.png" alt="daftar buku" style="max-width: 100%;" width="600px">
                            </a>
                        </div>
                    </div>
                </div>

            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content -->
    </div>
    <?php
    include '../layout/footer.php';
    ?>