<?php
include '../layout/header_user.php';
$user = $_SESSION['UserID'];
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../koneksi.php';
            $buku = mysqli_query($koneksi, "SELECT * FROM koleksipribadi INNER JOIN buku ON koleksipribadi.BukuID=buku.BukuID INNER JOIN user ON koleksipribadi.UserID=user.UserID WHERE user.UserID='$user'");
            while ($data = mysqli_fetch_array($buku)) {
            ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="Buku.php?id=<?= $data['BukuID']; ?>" style="text-decoration: none;">
                        <div class="card">
                            <div class="text-center">
                                <img src="../assets/img/images.jpeg" style="width: 120px;" class="card-img-top justify-content-center" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-secondary"><b><?= $data['Judul']; ?></b></h5>
                                <p class="card-text text-secondary"><?= $data['Penulis']; ?><br>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <small>(10)</small>
                                    <br>
                                    Tersedia : 4 / 4 <br>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php } ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php 
include '../layout/footer_user.php';
?>