<?php
session_start();
include '../server/connection.php';
include '../server/csrf.php';
$date_now = date('Y-m-d h:i:s');
$csrf = new csrf();
$register = array(
    'username',
    'password',
    'fristname',
    'lastname',
    'phone'
);
$form_names = $csrf->form_names($register, false);

if(isset($_POST[$form_names['username']], $_POST[$form_names['password']])) {
    // เช็คค่า POST
    if ($csrf->check_valid('post')) {
        $token    = $csrf->get_token();
        $username = $_POST[$form_names['username']];
        $password = $_POST[$form_names['password']];
        $password_hash = password_hash($_POST[$form_names['password']], PASSWORD_DEFAULT);
        $fristname = $_POST[$form_names['fristname']];
        $lastname = $_POST[$form_names['lastname']];
        $phone = $_POST[$form_names['phone']];
        $ip_address = $_SERVER['REMOTE_ADDR'];

        $sqli_register = "INSERT INTO _member (
            player_token,
            player_username,
            player_password,
            player_plain_password,
            player_fristname,
            player_lastname,
            player_phone_number,
            player_ip_address,
            player_note,
            create_time,
            update_time
        ) VALUES (
            '$token',
            '$username',
            '$password_hash',
            '$password',
            '$fristname',
            '$lastname',
            '$phone',
            '$ip_address',
            'สมัครใช้งาน สำเร็จ ยินดีต้อนรับ',
            '$date_now',
            '$date_now'
        )";

        if ($conn->query($sqli_register) === TRUE) {
            $return = ['status' => '200', 'mag' => 'สมัครสมาชิกสำเร็จ'];
            echo json_encode($return);
        } else {
            $return = ['status' => '404', 'mag' => $conn->error];
            echo json_encode($return);
        }
    }
}
