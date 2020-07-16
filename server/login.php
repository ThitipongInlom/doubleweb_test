<?php
session_start();
include '../server/connection.php';
include '../server/csrf.php';
$date_now = date('Y-m-d h:i:s');
$csrf = new csrf();
$login = array(
    'username',
    'password',
);
$form_names = $csrf->form_names($login, false);

if (isset($_POST[$form_names['username']], $_POST[$form_names['password']])) {
    // เช็คค่า POST
    if ($csrf->check_valid('post')) {
        // ดึงข้อมูล Username 
        $username = $_POST[$form_names['username']];
        $password = $_POST[$form_names['password']];
        $mysqli_login = "SELECT player_id,player_username, player_password FROM _member WHERE player_username = '$username'";
        if ($result = $conn->query($mysqli_login)) {
            while ($obj = $result->fetch_object()) {
                $player_id   = $obj->player_id;
                $username_db = $obj->player_username;
                $password_db = $obj->player_password;
            }
            $result->free_result();
        }
        // เริ่มเช็คค่าต่างๆ
        if(empty($username_db)) {
            $return = ['status' => '404', 'mag' => 'ไม่พบ Username'];
            echo json_encode($return);
        }else {
            if (password_verify($password, $password_db)) {
                $mysqli_login_success = "UPDATE _member SET
                    player_isActive = '1',
                    update_time = '$date_now'
                    WHERE player_id = $player_id
                ";
                $conn->query($mysqli_login_success);
                $_SESSION['player_isActive'] = '1';

                $return = ['status' => '200', 'mag' => 'ล็อกอินเข้าสู่ระบบ สำเร็จ'];
                echo json_encode($return);
            } else {
                $return = ['status' => '404', 'mag' => 'รหัสผ่านไม่ถูกต้อง'];
                echo json_encode($return);
            }            
        }
    }
}
