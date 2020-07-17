<?php
session_start();
include '../server/connection.php';
include '../server/csrf.php';
$date_now = date('Y-m-d h:i:s');
$csrf = new csrf();
$data_form = array(
    'player_id',
    'username',
    'password',
    'fristname',
    'lastname',
    'phone',
    'note'
);
$form_names = $csrf->form_names($data_form, false);

if ($_GET['action'] == 'Get_user') {
    $player_id = $_POST[$form_names['player_id']];
    $mysqli_getuser = "SELECT player_id, player_username, player_fristname, player_lastname, player_phone_number, player_note, create_time FROM _member WHERE player_id = '$player_id'";
    if ($result_Get_user = $conn->query($mysqli_getuser)) {
        while ($obj_Get_user = $result_Get_user->fetch_object()) {
            $data_get_user = $obj_Get_user;
        }
        $result_Get_user->free_result();
    }
    $return_Get_user = ['status' => '200', 'data' => $data_get_user];
    echo json_encode($return_Get_user);
}

if ($_GET['action'] == 'Get_edit_user') {
    $player_id = $_POST[$form_names['player_id']];
    $mysqli_getedituser = "SELECT player_id, player_username, player_password, player_plain_password, player_fristname, player_lastname, player_phone_number, player_note, create_time FROM _member WHERE player_id = '$player_id'";
    if ($result_Get_edit_user = $conn->query($mysqli_getedituser)) {
        while ($obj_Get_edit_user = $result_Get_edit_user->fetch_object()) {
            $data_edit_user = $obj_Get_edit_user;
        }
        $result_Get_edit_user->free_result();
    }
    $return_Get_edit_user = ['status' => '200', 'data' => $data_edit_user];
    echo json_encode($return_Get_edit_user);
}

if ($_GET['action'] == 'Save_edit_user') {
    $player_id = $_POST[$form_names['player_id']];
    $password = $_POST[$form_names['password']];
    $password_hash = password_hash($_POST[$form_names['password']], PASSWORD_DEFAULT);
    $fristname = $_POST[$form_names['fristname']];
    $lastname = $_POST[$form_names['lastname']];
    $phone = $_POST[$form_names['phone']];
    $note = $_POST[$form_names['note']];

    $mysqli_save_edit_user = "UPDATE _member SET
        player_password = '$password_hash',
        player_plain_password = '$password',
        player_fristname = '$fristname',
        player_lastname = '$lastname',
        player_phone_number = '$phone',
        player_note = '$note'
        WHERE player_id = $player_id
    ";

    if ($conn->query($mysqli_save_edit_user) === TRUE) {
        $return = ['status' => '200', 'mag' => 'แก้ไขข้อมูล สำเร็จ'];
        echo json_encode($return);
    } else {
        $return = ['status' => '404', 'mag' => $conn->error];
        echo json_encode($return);
    }
}

if ($_GET['action'] == 'Save_delete_user') {
    $player_id = $_POST[$form_names['player_id']];
    $mysqli_save_delete_user = "DELETE FROM _member WHERE player_id = $player_id";

    if ($conn->query($mysqli_save_delete_user) === TRUE) {
        $return = ['status' => '200', 'mag' => 'ลบข้อมูล สำเร็จ'];
        echo json_encode($return);
    } else {
        $return = ['status' => '404', 'mag' => $conn->error];
        echo json_encode($return);
    }
}
