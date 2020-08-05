<?php
include '../connection.php';
include 'ssp.class.php';
//ชื่อตาราง
$table = '_member';
//ชื่อคีย์หลัก
$primaryKey = 'player_id';
//ข้อมูลอะเรที่ส่งป datables
$columns = array(
    array('db' => 'player_username', 'dt' => 0),
    array('db' => 'player_fristname',  'dt' => 1),
    array('db' => 'player_lastname',   'dt' => 2),
    array('db' => 'player_phone_number',     'dt' => 3),
    array('db' => 'player_id',     'dt' => 4),
);

//ส่งข้อมูลกลับไปเป็น JSON
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns)
);
