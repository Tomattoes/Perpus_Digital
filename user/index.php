<?php
include '../layout/header_user.php';
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

        <form action="" method="post">
            <div class="modal-body">
                <div class="row">
                    <select name="select" id="select" class="form-control select2" style="width: 100%;" onchange="this.form.submit()">
                        <option value="">Semua Kategori</option>
                        <?php
                        include '../koneksi.php';
                        $member = mysqli_query($koneksi, "SELECT * FROM kategoribuku");
                        while ($data = mysqli_fetch_assoc($member)) { ?>
                            <option value="<?= $data['KategoriID']; ?>" <?php if (!$_POST) {
                                                                            echo "";
                                                                        } elseif ($_POST['select'] == $data['KategoriID']) {
                                                                            echo "selected";
                                                                        } ?>>
                                <?= $data['NamaKategori']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </form>

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container-fluid">
        <div class="row">
            <?php
            include '../koneksi.php';
            if (isset($_POST['select'])) {
                $kategori = $_POST['select'];
                $query = mysqli_query($koneksi, "SELECT * FROM kategoribuku_relasi INNER JOIN kategoribuku ON kategoribuku_relasi.KategoriID = kategoribuku.KategoriID INNER JOIN buku ON kategoribuku_relasi.BukuID = buku.BukuID WHERE kategoribuku.KategoriID='$_POST[select]'");
            } else {
                $query = mysqli_query($koneksi, "SELECT * FROM buku");
            }
            while ($data = mysqli_fetch_assoc($query)) {
            ?>
                <div class="col-lg-3 col-md-4 col-6">
                    <a href="Buku.php?id=<?= $data['BukuID']; ?>" style="text-decoration: none;">
                        <div class="card">
                            <div class="text-center">
                                <img src="../assets/img/<?= $data['foto']; ?>" style="width: 120px;" class="card-img-top justify-content-center" alt="...">
                            </div>
                            <div class="card-body">
                                <h5 class="card-title text-secondary"><b><?= $data['Judul']; ?></b></h5>
                                <p class="card-text text-secondary"><?= $data['Penulis']; ?><br>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <i class="fas fa-star"></i>
                                    <?php
                                    include '../koneksi.php';
                                    $id = $data['BukuID'];
                                    $ulasan = mysqli_query($koneksi, "SELECT COUNT(BukuID) as Total FROM ulasanbuku WHERE BukuID='$id'");
                                    while ($data1 = mysqli_fetch_array($ulasan)) {
                                    ?>
                                        <small>(<?= $data1['Total']; ?>)</small>
                                    <?php } ?>
                                    <br>
                                    Tersedia : <?= $data['stok']; ?> / <?= $data['JumlahBuku']; ?> <br>
                                </p>
                            </div>
                        </div>
                    </a>
                </div>
            <?php
            } ?>
        </div>
        <!-- /.row -->
    </div>
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php
include '../layout/footer_user.php';
?>