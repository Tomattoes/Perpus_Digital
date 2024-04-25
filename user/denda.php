<?php
include '../layout/header_user.php';
$id = $_SESSION['UserID'];
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
            <div class="card-header">
                <div class="card-title">
                    <h4>Denda</h4>
                </div>
                <div class="card-tools"><a class="btn btn-danger btn-sm" href="index.php"><i class="fas fa-arrow-left"> Back</i></a>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover" id="example2">
                    <thead>
                        <tr class="text-center text-bold bg-danger">
                            <td>Buku</td>
                            <td>ID Petugas</td>
                            <td>Peminjaman</td>
                            <td>Pengembalian</td>
                            <td>Keterlambatan</td>
                            <td>Denda</td>
                            <td>Aksi</td>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include '../koneksi.php';
                            $member = mysqli_query($koneksi, "SELECT * FROM peminjaman INNER JOIN user ON user.UserID = peminjaman.UserID INNER JOIN buku ON peminjaman.BukuID = buku.BukuID WHERE user.UserID='$id' AND Keterlambatan='YA' ORDER BY PeminjamanID DESC");
                        $no = 1;
                        while ($data = mysqli_fetch_array($member)) {
                        ?>
                            <tr>
                                <td><?= $data['Judul']; ?></td>
                                <td><?= $data['PetugasID']; ?></td>
                                <td><?= $data['TanggalPeminjaman']; ?></td>
                                <td><?= $data['TanggalPengembalian']; ?></td>
                                <td><?= $data['Keterlambatan']; ?></td>
                                <td><?= $data['Denda']; ?></td>
                                <td>
                                    <?php if ($data['Denda'] > 0) { ?>
                                        <a href="daftarDenda.php" class="btn btn-danger" onclick="return confirm('Temui Petugas Di Kasir Untuk Melunasi Denda!')">Bayar!</a>
                                    <?php   } else {
                                        echo "<button class='btn btn-success'>Lunas!</button>";
                                    } ?>
                                </td>
                            </tr>
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