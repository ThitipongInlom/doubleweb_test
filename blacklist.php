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
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">

    <title>CRUD Black List</title>
</head>

<body class="hold-transition sidebar-mini layout-fixed layout-navbar-fixed">
    <input type="hidden" name="<?= $token_id; ?>" id="from_id" value="<?= $token_value; ?>">
    <input type="hidden" name="<?= $form_names['player_id']; ?>" id="player_id">
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
                <span class="brand-text font-weight-light"><i class="fas fa-database"></i> CRUD Dashboard</span>
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
                                    <a href="member.php" class="nav-link">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>CRUD Member</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="blacklist.php" class="nav-link active">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>CRUD Blacklist</p>
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
                            <h1 class="m-0 text-dark">ข้อมูล Black List</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item active">CRUD Black List</li>
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
                            <div class="card card-dark">
                                <div class="card-header pb-2">
                                    <h2 class="card-title">
                                        <i class="fas fa-table"></i> ตารางข้อมูล Black List
                                    </h2>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-sm btn-success" onclick="Create_data_modal(this)"><i class="fas fa-user-plus"></i> สร้างข้อมูล</button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="member_table" class="table table-sm table-bordered" style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th>Fristname</th>
                                                    <th>Lastname</th>
                                                    <th>Phone</th>
                                                    <th>Bank</th>
                                                    <th>Block From</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Fristname</th>
                                                    <th>Lastname</th>
                                                    <th>Phone</th>
                                                    <th>Bank</th>
                                                    <th>Block From</th>
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
            <strong>Copyright &copy; 2020 <a href="https://thaiz.org/" target="_bank">thaiz</a>.</strong> All rights reserved.
        </footer>

        <!-- Modal create -->
        <div class="modal fade" id="create_data_modal" tabindex="-1" role="dialog" aria-labelledby="create_data_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="create_data_modalLabel"><i class="fas fa-user-plus"></i> Create Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="timeline mb-0">
                                   <div>
                                        <i class="fas fa-address-card bg-green"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <div class="row">
                                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                        <label for="create_fristname">Frist Name</label>
                                                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['fristname']; ?>" id="create_fristname" placeholder="Frist Name">
                                                    </div>
                                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                        <label for="create_lastname">Last Name</label>
                                                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['lastname']; ?>" id="create_lastname" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-phone bg-maroon"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="create_phone">Phone</label>
                                                <input type="number" class="form-control form-control-sm" name="<?= $form_names['phone']; ?>" id="create_phone" placeholder="Phone">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-university bg-indigo"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="create_bank">Bank</label>
                                                <input type="number" class="form-control form-control-sm" name="<?= $form_names['bank']; ?>" id="create_bank" placeholder="Bank">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-network-wired bg-teal"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="create_block_from">Block From</label>
                                                <input type="text" class="form-control form-control-sm" name="<?= $form_names['block_from']; ?>" id="create_block_from" placeholder="Block From">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-sticky-note bg-gray"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="edit_note">Note</label>
                                                <textarea class="form-control" name="<?= $form_names['note']; ?>" id="create_note" placeholder="Note" rows="3"></textarea>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-inline">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-success" id="btn_create" onclick="Save_Create()">เพิ่มข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal View -->
        <div class="modal fade" id="view_data_modal" tabindex="-1" role="dialog" aria-labelledby="view_data_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="view_data_modalLabel"><i class="fas fa-search"></i> View Info</h5>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="timeline mb-0">
                                    <div class="time-label">
                                        <span class="bg-primary create_blacklist_date">วันเวลาที่สร้าง Username</span>
                                    </div>
                                    <div>
                                        <i class="fas fa-address-card bg-green"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header name">Name :</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-phone bg-maroon"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header phone">Phone :</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-university bg-indigo"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header bank">Bank :</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-network-wired bg-teal"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header block_from">Block From :</h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-sticky-note bg-gray"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header note">Note :</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal"><i class="fas fa-times"></i></button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Edit -->
        <div class="modal fade" id="edit_data_modal" tabindex="-1" role="dialog" aria-labelledby="edit_data_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="edit_data_modalLabel"><i class="fas fa-edit"></i> Edit Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                                <div class="timeline mb-0">
                                   <div>
                                        <i class="fas fa-address-card bg-green"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <div class="row">
                                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                        <label for="edit_fristname">Frist Name</label>
                                                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['fristname']; ?>" id="edit_fristname" placeholder="Frist Name">
                                                    </div>
                                                    <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                        <label for="edit_lastname">Last Name</label>
                                                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['lastname']; ?>" id="edit_lastname" placeholder="Last Name">
                                                    </div>
                                                </div>
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-phone bg-maroon"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="edit_phone">Phone</label>
                                                <input type="number" class="form-control form-control-sm" name="<?= $form_names['phone']; ?>" id="edit_phone" placeholder="Phone">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-university bg-indigo"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="edit_bank">Bank</label>
                                                <input type="number" class="form-control form-control-sm" name="<?= $form_names['bank']; ?>" id="edit_bank" placeholder="Bank">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-network-wired bg-teal"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="edit_block_from">Block From</label>
                                                <input type="text" class="form-control form-control-sm" name="<?= $form_names['block_from']; ?>" id="edit_block_from" placeholder="Block From">
                                            </h3>
                                        </div>
                                    </div>
                                    <div>
                                        <i class="fas fa-sticky-note bg-gray"></i>
                                        <div class="timeline-item">
                                            <h3 class="timeline-header">
                                                <label for="edit_note">Note</label>
                                                <textarea class="form-control" name="<?= $form_names['note']; ?>" id="edit_note" placeholder="Note" rows="3"></textarea>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer d-inline">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger" data-dismiss="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-success" id="btn_edit" onclick="Save_Edit(this)">แก้ไขข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal Delete -->
        <div class="modal fade" id="delete_data_modal" tabindex="-1" role="dialog" aria-labelledby="delete_data_modalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header bg-dark">
                        <h5 class="modal-title" id="delete_data_modalLabel"><i class="fas fa-trash"></i> Delete Data</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="callout callout-danger mb-0">
                            <h5><i class="icon fas fa-exclamation-triangle"></i> แจ้งเตือนก่อนลบข้อมูล</h5>

                            <p>ยืนยันเพื่อลบข้อมูล เมื่อลบข้อมูลแล้วไม่สามารถนำข้อมูลเดิมกลับมาได้</p>
                        </div>
                    </div>
                    <div class="modal-footer d-inline">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-warning" data-dismiss="modal">ยกเลิก</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-danger" id="btn_delete" onclick="Save_Delete(this)">ลบข้อมูล</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</body>
<!-- Flie JS -->
<script src="assets/jquery/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src="assets/adminlte/js/adminlte.min.js"></script>
<script src="assets/datatables/datatables/jquery.dataTables.min.js"></script>
<script src="assets/datatables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="assets/moment/moment.min.js"></script>
<script src="assets/moment/locale/th.js"></script>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<!-- Script JS -->
<script src="script/crud_blacklist.js"></script>

</html>