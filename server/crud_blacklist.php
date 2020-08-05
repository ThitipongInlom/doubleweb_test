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
      'note',
      'bank',
      'block_from'
);
$form_names = $csrf->form_names($data_form, false);

if ($_GET['action'] == 'Save_black_list') {
    $fristname = $_POST[$form_names['fristname']];
    $lastname = $_POST[$form_names['lastname']];
    $phone = $_POST[$form_names['phone']];
    $bank = $_POST[$form_names['bank']];
    $block_from = $_POST[$form_names['block_from']];
    $note = $_POST[$form_names['note']];
    $player_Member = $_SESSION['player_Member'];

    $sqli_blacklist = "INSERT INTO blacklist_member (
        fristname,
        lastname,
        phone_number,
        bank_number,
        block_from,
        note,
        create_date,
        users_id
    ) VALUES (
        '$fristname',
        '$lastname',
        '$phone',
        '$bank',
        '$block_from',
        '$note',
        '$date_now',
        '$player_Member'
    )";
    if ($conn->query($sqli_blacklist) === TRUE) {
        $return = ['status' => '200', 'mag' => 'เพิ่มข้อมูล Blacklist เสร็จสิ้น'];
        echo json_encode($return);
    } else {
        $return = ['status' => '404', 'mag' => $conn->error];
        echo json_encode($return);
    }
}

if ($_GET['action'] == 'Get_user') {
    $player_id = $_POST[$form_names['player_id']];
    $mysqli_getuser = "SELECT fristname, lastname, phone_number, bank_number, block_from, note, create_date FROM blacklist_member WHERE log_id = '$player_id'";
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
    $mysqli_getedituser = "SELECT log_id, fristname, lastname, phone_number, bank_number, block_from, note, create_date FROM blacklist_member WHERE log_id = '$player_id'";
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
    $fristname = $_POST[$form_names['fristname']];
    $lastname = $_POST[$form_names['lastname']];
    $phone = $_POST[$form_names['phone']];
    $bank = $_POST[$form_names['bank']];
    $block_from = $_POST[$form_names['block_from']];
    $note = $_POST[$form_names['note']];

    $mysqli_save_edit_user = "UPDATE blacklist_member SET
        fristname = '$fristname',
        lastname = '$lastname',
        phone_number = '$phone',
        bank_number = '$bank',
        block_from = '$block_from',
        note = '$note'
        WHERE log_id = $player_id
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
    $mysqli_save_delete_user = "UPDATE blacklist_member SET is_delete = '1' WHERE log_id = $player_id";

    if ($conn->query($mysqli_save_delete_user) === TRUE) {
        $return = ['status' => '200', 'mag' => 'ลบข้อมูล สำเร็จ'];
        echo json_encode($return);
    } else {
        $return = ['status' => '404', 'mag' => $conn->error];
        echo json_encode($return);
    }
}