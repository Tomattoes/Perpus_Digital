<?php
include '../layout/header_user.php';
$id = $_GET['id'];
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
        <div class="card">
            <div class="text-center">
                <?php
                include '../koneksi.php';
                $buku = mysqli_query($koneksi, "SELECT * FROM buku INNER JOIN kategoribuku_relasi ON buku.BukuID=kategoribuku_relasi.BukuID INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID=kategoribuku.KategoriID WHERE buku.BukuID='$id'");
                while ($data = mysqli_fetch_array($buku)) {
                ?>
                    <img src="../assets/img/<?= $data['foto']; ?>" style="width: 120px;" class="card-img-top justify-content-center" alt="...">
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <h5 class="card-title text-secondary"><b><?= $data['Judul']; ?></b></h5><br>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <?php
                        include '../koneksi.php';
                        $ulasan = mysqli_query($koneksi, "SELECT COUNT(BukuID) as Total FROM ulasanbuku WHERE BukuID='$id'");
                        while ($data1 = mysqli_fetch_array($ulasan)) {
                        ?>
                            <small>(<?= $data1['Total']; ?> ulasan)</small>
                        <?php } ?>
                        <br><br>
                    </div>
                    <div class="col-6">
                        <?php
                        $fav = mysqli_query($koneksi, "SELECT * FROM koleksipribadi WHERE UserID='$user'");
                        $q1 = mysqli_fetch_array($fav); {
                            if (!isset($q1['BukuID'])) { ?>
                                <a href="fungsi/tambahFavorit.php?id=<?= $id; ?>&user=<?= $_SESSION['UserID']; ?>" class="btn btn-info"><i class="fas fa-bookmark" style="color: white;"></i></a>
                            <?php } elseif ($q1['BukuID'] == $id) { ?>
                                <a href="fungsi/hapusFavorit.php?id=<?= $id; ?>&user=<?= $_SESSION['UserID']; ?>" class="btn btn-info"><i class="fas fa-bookmark" style="color: yellow;"></i></a>
                            <?php } else { ?>
                                <a href="fungsi/tambahFavorit.php?id=<?= $id; ?>&user=<?= $_SESSION['UserID']; ?>" class="btn btn-info"><i class="fas fa-bookmark" style="color: white;"></i></a>
                        <?php }
                        } ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-6">
                        <?php
                        if ($data['stok'] > 0) { ?>
                            <button class="btn btn-info"><b>Tersedia</b></button>
                        <?php
                        } else { ?>
                            <button class="btn btn-default"><b>Stok Habis</b></button>
                        <?php } ?>
                    </div>
                    <!-- <div class="col-6">
                            <?php if ($data['stok'] > 0) { ?>
                                <button class="btn btn-default" disabled><b>Beritahu Saya</b></button>
                            <?php } else { ?>
                                <a href="fungsi/daftarTunggu.php?id=<?= $data['BukuID'] ?>&user=<?= $_SESSION['UserID'] ?>" class="btn btn-warning"><b>Beritahu Saya</b></a>
                            <?php } ?>
                        </div> -->
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item text-center"><b>Informasi</b></li>
                    <table class="m-2">
                        <tr>
                            <td><small>Penulis</small></td>
                            <td><small><?= $data['Penulis']; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Penerbit</small></td>
                            <td><small><?= $data['Penerbit']; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Kategori</small></td>
                            <td><small><?= $data['NamaKategori']; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Jumlah Halaman</small></td>
                            <td><small><?= $data['jumlah_halaman']; ?></small></td>
                        </tr>
                        <tr>
                            <td><small>Rak</small></td>
                            <td><small><?= $data['LokasiRak']; ?></small></td>
                        </tr>
                    </table>
                    <li class="list-group-item text-center"><b>Rating & Ulasan</b></li>
                    <div class="text-center mt-3">
                        <p><a href="ulasan.php?id=<?= $id; ?>">Lihat Semua Ulasan</a></p>
                    </div>
                </ul>
                </p>
            <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
include '../layout/footer_user.php';
?>