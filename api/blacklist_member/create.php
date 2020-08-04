<?php
ini_set("display_errors", 1);
// include vendor
require '../../vendor/autoload.php';
use Firebase\JWT\JWT;

//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../../server/connection.php");

if($_SERVER['REQUEST_METHOD'] === "POST"){
    // body
    $data = json_decode(file_get_contents("php://input"));
    // head
    $all_headers = getallheaders();

    if (!empty($data->fristname) && !empty($data->lastname) && !empty($data->phone_number) && !empty($data->bank_number) && !empty($data->block_from)) {
        if (isset($all_headers["Authorization"])) {

            $jwt = $all_headers['Authorization'];

            if (!empty($jwt)) {
                try {

                    $secret_key = "owt125";

                    $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));

                    $date_now = date('Y-m-d H:i:s');

                    $user_id = $decoded_data->data->id;
                    $sqli_create = "INSERT INTO blacklist_member (
                        fristname,
                        lastname,
                        phone_number,
                        bank_number,
                        block_from,
                        note,
                        create_date,
                        users_id
                    ) VALUES (
                        '$data->fristname',
                        '$data->lastname',
                        '$data->phone_number',
                        '$data->bank_number',
                        '$data->block_from',
                        '$data->note',
                        '$date_now',
                        '$user_id'
                    )";

                    $conn->query($sqli_create);

                    http_response_code(200);
                    echo json_encode(array(
                        "status" => 1,
                        "message" => 'บันทึก เสร็จสิ้น'
                    ));
                } catch (Exception $ex) {

                    http_response_code(500); 
                    echo json_encode(array(
                        "status" => 0,
                        "message" =>  $ex->getMessage()
                    ));
                }
            }else {
                http_response_code(404); 
                echo json_encode(array(
                    "status" => 0,
                    "message" => "ไม่มี Token"
                ));           
            }

        }else {
            http_response_code(404); 
            echo json_encode(array(
                "status" => 0,
                "message" => "ไม่มี Token"
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