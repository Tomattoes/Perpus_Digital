<?php
include '../layout/header_user.php';
$id = $_GET['id'];
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
            <li class="list-group-item text-center"><b>Rating & Ulasan</b></li>
            <div class="card-body">
                <?php
                include '../koneksi.php';
                $ulasan = mysqli_query($koneksi, "SELECT * FROM ulasanbuku INNER JOIN user ON ulasanbuku.UserID=user.UserID WHERE BukuID='$id'");
                while ($data1 = mysqli_fetch_array($ulasan)) {
                    $email = $data1['Email'];
                    $pjg = strlen($email);
                    $ptg = substr($email, 0, 4);
                    $btg = str_repeat("*", $pjg - 4);
                    $hasil = $ptg . $btg;
                ?>
                    <div class="d-flex justify-content-between">
                        <small><?= $hasil; ?></small>
                        <small class="text-secondary"><?= $data1['Tanggal']; ?></small>
                    </div>
                    <div class="p-2">
                        <div class="row"><small style="color: orange;"><?= substr($data1['Rating'], 0, 3); ?>/5</small></div>
                        <div class="row"><small><?= $data1['Ulasan']; ?></small></div>
                        <hr>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>

<?php
include '../layout/footer_user.php';
?>