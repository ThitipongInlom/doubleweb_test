<?php
session_start();
include 'server/register.php';
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Flie CSS -->
    <link rel="stylesheet" href="assets/bootstrap/css/bootstrap.css">
    <link rel="srylesheet" href="assets/adminlte/css/adminlte.css">
    <link rel="stylesheet" href="assets/fontawesome/css/all.css">

    <title>ทดสอบ Login Ajax</title>
</head>

<body>
    <!-- Login App -->
    <div class="container-fluid">
        <div class="row py-5">
            <div class="offset-4 offset-sm-4 offset-md-4 offset-lg-4 col-4 col-sm-4 col-md-4 col-lg-4">
                <div class="card card-danger form">
                    <div class="card-header">
                        <h3 class="card-title text-center mb-0">Login APP</h3>
                    </div>
                    <div class="card-body">
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-user"></i></span>
                            </div>
                            <input type="username" class="form-control" id="login_username" placeholder="Username">
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-lock"></i></span>
                            </div>
                            <input type="password" class="form-control" id="login_password" placeholder="Password">
                        </div>
                    </div>
                    <div class="card-footer clearfix">
                        <div class="row">
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-outline-warning" onclick="Show_register()"><i class="fas fa-registered"></i> สมัครสมาชิก</button>
                            </div>
                            <div class="col-6">
                                <button type="button" class="btn btn-sm btn-block btn-outline-success"><i class="fas fa-sign-in-alt"></i> ล็อกอิน</button>
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
                <div class="modal-header">
                    <h5 class="modal-title" id="registerModalLabel">สมัครสมาชิก</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="<?= $token_id; ?>" id="from_id" value="<?= $token_value; ?>">
                    <div class="form-group">
                        <label for="register_username">Username</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['username']; ?>" id="register_username" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="register_password">Password</label>
                        <input type="text" class="form-control form-control-sm" name="<?= $form_names['password']; ?>" id="register_password" placeholder="Password">
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
                    <button type="button" class="btn btn-sm btn-outline-success" onclick="Save_register()"><i class="fas fa-save"></i> ยืนยันการ สมัครสมาชิก</button>
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
<script src="script/register.js"></script>

</html>