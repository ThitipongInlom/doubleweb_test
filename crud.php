<?php
session_start();
if (empty($_SESSION['player_isActive'])) {
    header('Location: index.php');
}
include 'server/set_csrf.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Flie CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="assets/adminlte/css/adminlte.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">
    <link rel="stylesheet" href="assets/datatables/datatables-bs4/css/dataTables.bootstrap4.min.css">

    <title>CRUD Ajax</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">

        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a href="server/logout.php" class="nav-link"><i class="fas fa-sign-out-alt"></i> ออกจากระบบ</a>
                </li>
            </ul>
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="#" class="brand-link text-center">
                <span class="brand-text font-weight-light"><i class="fas fa-database"></i> CRUD Ajax</span>
            </a>
            <!-- Sidebar -->
            <div class="sidebar">
                <!-- Sidebar Menu -->
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                        <li class="nav-item has-treeview menu-open">
                            <a href="#" class="nav-link active">
                                <i class="nav-icon fas fa-tachometer-alt"></i>
                                <p>
                                    เมนูหลัก
                                    <i class="right fas fa-angle-left"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="crud.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>CRUD Ajax</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">อัพเดต ข้อมูล Player</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">CRUD Ajax</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <div class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="card card-primary">
                                <div class="card-header pb-2">
                                    <h2 class="card-title">
                                        <i class="fas fa-table"></i> ตารางข้อมูล Player
                                    </h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-success"><i class="fas fa-user-plus"></i> สร้างข้อมูล</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="example" class="table table-sm table-striped table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Fristname</th>
                                                    <th>Lastname</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Username</th>
                                                    <th>Fristname</th>
                                                    <th>Lastname</th>
                                                    <th>Phone Number</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.content-wrapper -->

        <!-- Main Footer -->
        <footer class="main-footer">
            <!-- To the right -->
            <div class="float-right d-none d-sm-inline">
                <b>Version</b> 0.0.1
            </div>
            <!-- Default to the left -->
            <strong>Copyright &copy; 2020 <a href="https://github.com/ThitipongInlom" target="_bank">Thitipong Inlom</a>.</strong> All rights reserved.
        </footer>
    </div>
</body>
<!-- Flie JS -->
<script src="assets/jquery/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src="assets/adminlte/js/adminlte.min.js"></script>
<script src="assets/datatables/datatables/jquery.dataTables.min.js"></script>
<script src="assets/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- Script JS -->
<script src="script/crud.js"></script>

</html>