<?php
include '../layout/header_user.php';
$id = $_GET['id'];
$Koleksi = $_GET['koleksiID'];
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
                <img src="../assets/img/images.jpeg" style="width: 120px;" class="card-img-top justify-content-center" alt="...">
            </div>
            <div class="card-body">
                <?php
                include '../koneksi.php';
                $buku = mysqli_query($koneksi, "SELECT * FROM buku INNER JOIN kategoribuku_relasi ON buku.BukuID=kategoribuku_relasi.BukuID INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID=kategoribuku.KategoriID WHERE buku.BukuID='$id'");
                while ($data = mysqli_fetch_array($buku)) {
                ?>
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title text-secondary"><b><?= $data['Judul']; ?></b></h5><br>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <small>(10 ulasan)</small>
                            <br><br>
                        </div>
                        <div class="col-6"><a href="fungsi/hapusFavorit.php?id=<?= $Koleksi; ?>" class="btn btn-info"><i class="fas fa-bookmark" style="color: yellow;"></i></a></div>
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
                        <div class="col-6">
                            <?php if ($data['stok'] > 0) { ?>
                                <button class="btn btn-default" disabled><b>Beritahu Saya</b></button>
                            <?php } else { ?>
                                <a href="fungsi/daftarTunggu.php?id=<?= $data['BukuID'] ?>&user=<?= $_SESSION['UserID'] ?>" class="btn btn-warning"><b>Beritahu Saya</b></a>
                            <?php } ?>
                        </div>
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item">Informasi</li>
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
                        <li class="list-group-item">Rating & Ulasan</li>
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