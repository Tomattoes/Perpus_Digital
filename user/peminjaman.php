<?php
include '../layout/header_user.php';
$id = $_SESSION['UserID'];
$date = date('Y-m-d H:i:s'); // Format tanggal dan waktu default (tahun-bulan-tanggal jam:menit:detik)
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
        <?php
        if (isset($_GET['info'])) {
            if ($_GET['info'] == "simpan") {
        ?>
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5><i class="icon fas fa-checked"></i> Terimakasih</h5>
                    Ulasan Anda telah tercatat!
                </div>
        <?php }
        } ?>
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>Peminjaman Buku</h4>
                </div>
                <div class="card-tools"><a class="btn btn-danger btn-sm" href="index.php"><i class="fas fa-arrow-left"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="example2">
                    <thead>
                        <tr class="text-center text-bold bg-info">
                            <td>Buku</td>
                            <td>ID Petugas</td>
                            <td>Peminjaman</td>
                            <td>Pengembalian</td>
                            <td>Status</td>
                            <td>#</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../koneksi.php';
                        $member = mysqli_query($koneksi, "SELECT * 
                                    FROM peminjaman p, user u, buku b, kategoribuku_relasi kt, kategoribuku kb
                                    WHERE p.UserID=u.UserID AND p.BukuID=b.BukuID AND kt.KategoriID=kb.KategoriID AND kt.BukuID=b.BukuID AND  u.UserID='$id' ORDER BY PeminjamanID DESC");
                        $no = 1;
                        while ($data = mysqli_fetch_array($member)) {
                        ?>
                            <tr>
                                <td><?= $data['Judul']; ?></td>
                                <td><?= $data['PetugasID']; ?></td>
                                <td><?= $data['TanggalPeminjaman']; ?></td>
                                <td><?= $data['TanggalPengembalian']; ?></td>
                                <td style="width: 155px;">
                                    <?= $data['StatusPeminjaman']; ?>
                                </td>
                                <td style="width: 155px;">
                                    <button data-toggle="modal" data-target="#modal-tambah<?= $data['BukuID']; ?>" class="btn btn-sm btn-info"><i class="fas fa-book"></i> Beri Ulasan</button>
                                </td>
                            </tr>

                            <div class="modal fade" id="modal-tambah<?= $data['BukuID']; ?>">
                                <div class="modal-dialog modal-md">
                                    <div class="modal-content">

                                        <div class="modal-header">
                                            <h4 class="modal-title">Beri Ulasan</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="fungsi/simpan_ulasan.php" method="post">
                                            <div class="modal-body">
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="">Buku</label>
                                                        <input type="hidden" name="buku" class="form-control" value="<?= $data['BukuID']; ?>">
                                                        <input type="hidden" name="user" class="form-control" value="<?= $id; ?>">
                                                        <input type="hidden" name="tgl" class="form-control" value="<?= $date; ?>">
                                                        <input type="text" class="form-control" value="<?= $data['Judul']; ?>" readonly>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="">Rating</label>
                                                        <input type="text" name="rating" class="form-control" placeholder="Rating (1-5)" required maxlength="1"></input>
                                                    </div>
                                                </div>
                                                <div class="col">
                                                    <div class="form-group">
                                                        <label for="">Ulasan</label>
                                                        <textarea type="text" name="ulasan" class="form-control" placeholder="Ketik ulasan Anda disini" required></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer justify-content-center">
                                                <button type="submit" class="btn btn-primary">Simpan</button>
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
    <!-- /.container-fluid -->
</div>
<!-- /.content -->

<?php
include '../layout/footer_user.php';
?>