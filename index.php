<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Digital</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="assets/plugins/fontawesome-free/css/all.min.css">
    <!-- icheck bootstrap -->
    <link rel="stylesheet" href="assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="assets/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
    <div class="login-box">
        <!-- /.login-logo -->
        <div class="login-logo">
            <p class="h1"><b>Perpus </b>Digital</p>
        </div>
        <div class="card">
            <div class="card-body login-card-body">
                <h4 class="login-box-msg"><b>Portal Login Perpustakaan Digital</b></h4>
                <?php
                if (isset($_GET['info'])) {
                    if ($_GET['info'] == "gagal") {
                ?>
                        <div class="alert alert-warning alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-exclamation-triangle"></i> Mohon Maaf</h5>
                            Login gagal! Username atau Password salah!
                        </div>
                    <?php } elseif ($_GET['info'] == "logout") {
                    ?>
                        <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Terima Kasih</h5>
                            Anda telah berhasil logout!
                        </div>
                    <?php } elseif ($_GET['info'] == "login") {
                    ?> <div class="alert alert-info alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-info"></i> Mohon Maaf</h5>
                            Anda harus login terlebih dahulu!
                        </div>
                    <?php } elseif ($_GET['info'] == "registration_success") {
                    ?> <div class="alert alert-success alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Selamat</h5>
                            Akun Anda berhasil terdaftar!
                        </div>
                    <?php } elseif ($_GET['info'] == "gagal_registration") {
                    ?> <div class="alert alert-danger alert-dismissible">
                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h5><i class="icon fas fa-check"></i> Mohon Maaf</h5>
                           Password dan Re-type Password Anda Tidak Sama! Silahkan Daftar Kembali!
                        </div>
                <?php }
                } ?>

                <form action="config/cek_login.php" method="post">
                    <div class="input-group mb-3">
                        <input type="text" name="username" class="form-control" placeholder="Username" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-user"></span>
                            </div>
                        </div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" class="form-control" placeholder="Password" required>
                        <div class="input-group-append">
                            <div class="input-group-text">
                                <span class="fas fa-lock"></span>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-6">
                            <button type="submit" class="btn btn-info btn-block">Log In</button>
                        </div>
                    </div>
                    <hr>
                    <div style="text-align:center">
                        <span>Don't have an account yet ? <a href="registrasi.php"> Sign Up</a></span>
                    </div>
                </form>

            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.login-box -->

    <!-- jQuery -->
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap 4 -->
    <script src="assets/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- AdminLTE App -->
    <script src="assets/dist/js/adminlte.min.js"></script>
</body>

</html>