<?php
session_start();

if ($_SESSION['role'] != "user") {
    header("location:../index.php?info=login");
} else if ($_SESSION['role'] == "") {
    header("location:../index.php?info=login");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perpus Digital</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="../assets/plugins/fontawesome-free/css/all.min.css">
    <!-- IonIcons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- DataTables -->
    <link rel="stylesheet" href="../assets/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/dist/css/adminlte.min.css">

</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <!-- Left navbar links -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
                <li class="nav-item d-none d-sm-inline-block">
                    <a href="../user/index.php" class="nav-link">Home</a>
                </li>
            </ul>

            <!-- Right navbar links -->
            <ul class="navbar-nav ml-auto">
                <!-- Navbar Search -->
                <li class="nav-item">
                    <a class="nav-link" data-widget="navbar-search" href="#" role="button">
                        <i class="fas fa-search"></i>
                    </a>
                    <div class="navbar-search-block">
                        <form class="form-inline">
                            <div class="input-group input-group-sm">
                                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                                <div class="input-group-append">
                                    <button class="btn btn-navbar" type="submit">
                                        <i class="fas fa-search"></i>
                                    </button>
                                    <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </li>

            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">

            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar user panel (optional) -->
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="image mt-2">
                        <img src="../assets/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
                    </div>
                    <div class="info text-white">
                        <a class="d-block"><b><?= $_SESSION['NamaLengkap']; ?></b></a>
                        <a class="d-block"><?= $_SESSION['Email']; ?></a>
                    </div>
                </div>

                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item">
                            <a href="../user/index.php" class="nav-link">
                                <i class="fas fa-book nav-icon"></i>
                                <p>Perpustakaan</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="../user/Profil.php" class="nav-link">
                                <i class="fas fa-user nav-icon"></i>
                                <p>Profil</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="nav-link">
                                <i class="nav-icon fas fa-clock"></i>
                                <p>
                                    Riwayat Peminjaman
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="peminjaman.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Peminjaman
                                        </p>
                                    </a>
                                </li>
                                <!-- <li class="nav-item">
                                    <a href="pages/widgets.html" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Pengembalian
                                        </p>
                                    </a>
                                </li> -->
                                <li class="nav-item">
                                    <a href="denda.php" class="nav-link">
                                        <i class="nav-icon far fa-circle"></i>
                                        <p>
                                            Denda
                                        </p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a href="../user/favorit.php" class="nav-link">
                                <i class="fas fa-bookmark nav-icon"></i>
                                <p>Favorit</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="pages/layout/top-nav-sidebar.html" class="nav-link">
                                <i class="fas fa-list fa-check nav-icon"></i>
                                <p>Daftar Tunggu</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="../logout.php" onclick="return confirm('Apakah Anda Yakin Ingin Log Out Dari Akun Ini?')" class="nav-link">
                                <i class="fas fa-arrow-left nav-icon"></i>
                                <p>Log Out</p>
                            </a>
                        </li>
                    </ul>
                </nav>
                <!-- /.sidebar-menu -->
            </div>
            <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">