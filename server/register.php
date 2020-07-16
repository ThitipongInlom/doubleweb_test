<?php
session_start();
include '../server/csrf.php';
$csrf = new csrf();
$register = array('username',
                  'password',
                  'fristname',
                  'lastname',
                  'phone'
            );
$form_names = $csrf->form_names($register, false);

if($csrf->check_valid('post')) {
    $user = $_POST[$form_names['username']];
    echo $user;
    echo '<br>';
    $hash = password_hash("rasmuslerdorf", PASSWORD_DEFAULT);

    if (password_verify('rasmuslerdorf', $hash)) {
        echo 'Password is valid!';
    } else {
        echo 'Invalid password.';
    }
}
