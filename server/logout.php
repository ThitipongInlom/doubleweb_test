<?php
session_start();
include '../server/connection.php';
$date_now = date('Y-m-d H:i:s');
$player_id = $_SESSION['player_Member'];
$mysqli_logout = "UPDATE _member SET
    player_isActive = '0',
    update_time = '$date_now'
    WHERE player_id = $player_id
";
$conn->query($mysqli_logout);
session_unset();
session_destroy();
header('Location: ../index.php');