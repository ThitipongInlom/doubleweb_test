<?php
session_start();
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
    <link rel="stylesheet" href="assets/sweetalert2/sweetalert2.min.css">

    <title>ทดสอบ Login Ajax</title>
</head>

<body class="hold-transition login-page" style="background-image: url('assets/image/background.jpg'); height: auto; min-height: 100%;">
    <input type="hidden" name="<?= $token_id; ?>" id="from_id" value="<?= $token_value; ?>">
    <!-- Login App -->
    <div class="container-fluid">
        <div class="row py-5">
            <div class="offset-1 offset-sm-1 offset-md-4 offset-lg-4 col-10 col-sm-10 col-md-4 col-lg-4">
                <div class="login-box">
                    <div class="card card_login">
                        <div class="card-body login-card-body">
                            <div class="text-center">
                                <h2 class="text-dark">LOGIN AJAX</h2>
                            </div>
                            <hr calss="mb-3">
                            <div class="input-group mb-3 mt-3">
                                <input type="username" class="form-control" name="<?= $form_names['username']; ?>" id="login_username" onkeyup="Check_password_special(this)" placeholder="Username" autocomplete="off" autofocus>
                                <div class="input-group-append input-group-text">
                                    <i class="fas fa-user"></i>
                                </div>
                            </div>
                            <div class="input-group mb-3">
                                <input type="password" class="form-control" name="<?= $form_names['password']; ?>" id="login_password" onkeyup="Check_password_special(this)" placeholder="Password" autocomplete="off">
                                <div class="input-group-append input-group-text">
                                    <i class="fas fa-lock"></i>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-outline-warning" onclick="Show_register()"><i class="fas fa-registered"></i> สมัครสมาชิก</button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-sm btn-block btn-outline-success" id="btn_login" onclick="Save_login()"><i class="fas fa-sign-in-alt"></i> ล็อกอิน</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header bg-dark">
                    <h5 class="modal-title" id="registerModalLabel"><i class="fas fa-user-plus"></i> สมัครสมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
                            <div class="timeline mb-0">
                                <div>
                                    <i class="fas fa-user bg-blue"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">
                                            <label for="register_username">Username</label>
                                            <input type="text" class="form-control form-control-sm" name="<?= $form_names['username']; ?>" id="register_username" placeholder="Username">
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-lock bg-cyan"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">
                                            <label for="register_password">Password</label>
                                            <input type="text" class="form-control form-control-sm" name="<?= $form_names['password']; ?>" id="register_password" onkeyup="Check_password_special(this)" placeholder="Password">
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-address-card bg-green"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">
                                            <div class="row">
                                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="register_fristname">Frist Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="<?= $form_names['fristname']; ?>" id="register_fristname" placeholder="Frist Name">
                                                </div>
                                                <div class="col-6 col-sm-6 col-md-6 col-lg-6">
                                                    <label for="register_lastname">Last Name</label>
                                                    <input type="text" class="form-control form-control-sm" name="<?= $form_names['lastname']; ?>" id="register_lastname" placeholder="Last Name">
                                                </div>
                                            </div>
                                        </h3>
                                    </div>
                                </div>
                                <div>
                                    <i class="fas fa-phone bg-maroon"></i>
                                    <div class="timeline-item">
                                        <h3 class="timeline-header">
                                            <label for="register_phone">Phone</label>
                                            <input type="number" class="form-control form-control-sm" name="<?= $form_names['phone']; ?>" id="register_phone" placeholder="Phone">
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-block btn-outline-success" onclick="Save_register()" id="btn_register"><i class="fas fa-save"></i> ยืนยันการ สมัครสมาชิก</button>
                </div>
            </div>
        </div>
    </div>

</body>
<!-- Flie JS -->
<script src="assets/jquery/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="assets/bootstrap/js/bootstrap.js"></script>
<script src="assets/adminlte/js/adminlte.js"></script>
<script src="assets/sweetalert2/sweetalert2.min.js"></script>
<!-- Script JS -->
<script src="script/login.js"></script>
<script src="script/register.js"></script>

</html>