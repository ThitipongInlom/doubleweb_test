<?php
ini_set("display_errors", 1);
// include vendor
require '../../vendor/autoload.php';

use \Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../../server/connection.php");

if($_SERVER['REQUEST_METHOD'] === "POST") {

    // body
    $data = json_decode(file_get_contents("php://input"));
    // head
    $all_headers = getallheaders();

    if (!empty($data->phone_number) OR !empty($data->bank_number)) {
        // Phone Number
        if (!empty($data->phone_number)) {
            $phone_number = "is_delete != '1' AND  phone_number = '$data->phone_number'";
        }else {
            $phone_number = "";
        }
        // Bank Number
        if (!empty($data->bank_number)) {
            $bank_number  = "OR is_delete != '1' AND bank_number = '$data->bank_number'";
        }else {
            $bank_number  = "";
        }
        // Query
        $sql_seacrh = "SELECT * FROM blacklist_member WHERE $phone_number $bank_number";

        if ($result = $conn->query($sql_seacrh)) {
            while ($obj = $result->fetch_object()) {
                $fristname   = $obj->fristname;
                $lastname = $obj->lastname;
                $phone_number = $obj->phone_number;
                $bank_number = $obj->bank_number;
                $block_from = $obj->block_from;

                $check_id = $obj->log_id;
            }
            $result->free_result();
        }
        if (!empty($check_id)) {
            http_response_code(200);
            echo json_encode(array(
                "status" => 0,
                "message" => "Block"
            ));
        }else {
            http_response_code(200);
            echo json_encode(array(
                "status" => 0,
                "message" => "None"
            ));
        }  
    }else {
        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "message" => "ข้อมูลไม่ครบ"
        ));
    }
}