<?php
include '../layout/header_admin.php';
include '../layout/navbar.php';
$UserID = $_SESSION['UserID'];
?>

<!-- Content Header (Page header) -->
<div class="content-header">
    <div class="container-fluid">

    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<!-- Main content -->
<div class="content">
    <div class="container">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <h4>Profile</h4>
                </div>
            </div>

            <form class="form-horizontal">
                <div class="card-body">
                    <?php
                    include '../koneksi.php';
                    $member = mysqli_query($koneksi, "SELECT * FROM user WHERE UserID='$UserID' ");
                    while ($data = mysqli_fetch_array($member)) {
                    ?>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">ID</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="<?= $data['UserID']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Lengkap</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputEmail3" placeholder="Email" value="<?= $data['NamaLengkap']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Username']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Email</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Email']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['No_HP']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Alamat']; ?>" readonly>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="inputPassword3" class="col-sm-2 col-form-label">Tanggal Daftar</label>
                            <div class="col-sm-10">
                                <input type="date" class="form-control" id="inputPassword3" placeholder="Password" value="<?= $data['Tanggal_Pendaftaran']; ?>" readonly>
                            </div>
                        </div>
                </div>
            <?php } ?>
            </form>
        </div>
    </div>
</div>

<?php
include '../layout/footer.php';
?>