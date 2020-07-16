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

    <title>ทดสอบ Login Ajax</title>
</head>

<body class="login-page">
    <input type="hidden" name="<?= $token_id; ?>" id="from_id" value="<?= $token_value; ?>">
    <!-- Login App -->
    <div class="container-fluid">
        <div class="row py-5">
            <div class="offset-1 offset-sm-1 offset-md-4 offset-lg-4 col-10 col-sm-10 col-md-4 col-lg-4">
                <div class="card card-primary form">
                    <div class="card-header">
                        <h3 class="card-title text-center mb-0">Login APP</h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="username" class="form-control" name="<?= $form_names['username']; ?>" id="login_username" onkeyup="Check_password_special(this)" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" name="<?= $form_names['password']; ?>" id="login_password" onkeyup="Check_password_special(this)" placeholder="Password">
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="row">
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

    <!-- Modal Register -->
    <div class="modal fade" id="register" tabindex="-1" role="dialog" aria-labelledby="registerModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header bg-primary">
                    <h5 class="modal-title" id="registerModalLabel"><i class="fas fa-user-plus"></i> สมัครสมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="register_username">Username</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['username']; ?>" id="register_username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="register_password">Password</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['password']; ?>" id="register_password" onkeyup="Check_password_special(this)" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="register_fristname">Frist Name</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['fristname']; ?>" id="register_fristname" placeholder="Frist Name">
                    </div>
                    <div class="form-group">
                        <label for="register_lastname">Last Name</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['lastname']; ?>" id="register_lastname" placeholder="Last Name">
                    </div>
                    <div class="form-group">
                        <label for="register_phone">Phone</label>
                        <input type="number" class="form-control form-control-sm" name="<?= $form_names['phone']; ?>" id="register_phone" placeholder="Phone">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="Save_register()" id="btn_register"><i class="fas fa-save"></i> ยืนยันการ สมัครสมาชิก</button>
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
<!-- Script JS -->
<script src="script/login.js"></script>
<script src="script/register.js"></script>

</html>