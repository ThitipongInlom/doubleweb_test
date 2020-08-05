<?php
include '../connection.php';
include 'ssp.class.php';
//ชื่อตาราง
$table = 'blacklist_member';
//ชื่อคีย์หลัก
$primaryKey = 'log_id';
//ข้อมูลอะเรที่ส่งป datables
$columns = array(
    array('db' => 'fristname', 'dt' => 0),
    array('db' => 'lastname',  'dt' => 1),
    array('db' => 'phone_number','dt' => 2),
    array('db' => 'bank_number','dt' => 3),
    array('db' => 'block_from', 'dt' => 4),
    array('db' => 'log_id',  'dt' => 5),
);

$where = "is_delete != '1'";


//ส่งข้อมูลกลับไปเป็น JSON
echo json_encode(
    SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $where)
);
