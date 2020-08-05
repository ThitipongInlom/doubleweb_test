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

    if (!empty($data->log_id)) {
        if (isset($all_headers["Authorization"])) {

            $jwt = $all_headers['Authorization'];

            if (!empty($jwt)) {
                try {

                    $secret_key = "owt125";

                    $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));

                    $user_id = $decoded_data->data->id;

                    $mysqli_delete = "UPDATE blacklist_member SET
                        is_delete = '1'
                        WHERE log_id = $data->log_id
                    ";

                    $conn->query($mysqli_delete);
                    
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
        } else {
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "ไม่มี Token"
            ));
        }
    }else if (!empty($data->bank_number)) {
        if (isset($all_headers["Authorization"])) {

            $jwt = $all_headers['Authorization'];

            if (!empty($jwt)) {
                try {

                    $secret_key = "owt125";

                    $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));

                    $user_id = $decoded_data->data->id;

                    $mysqli_delete = "UPDATE blacklist_member SET
                        is_delete = '1'
                        WHERE bank_number = $data->bank_number
                    ";

                    $conn->query($mysqli_delete);
                    
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
        } else {
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "ไม่มี Token"
            ));
        }
    }else if (!empty($data->phone_number)) {
        if (isset($all_headers["Authorization"])) {

            $jwt = $all_headers['Authorization'];

            if (!empty($jwt)) {
                try {

                    $secret_key = "owt125";

                    $decoded_data = JWT::decode($jwt, $secret_key, array('HS512'));

                    $user_id = $decoded_data->data->id;

                    $mysqli_delete = "UPDATE blacklist_member SET
                        is_delete = '1'
                        WHERE phone_number = $data->phone_number
                    ";

                    $conn->query($mysqli_delete);
                    
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
        } else {
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "ไม่มี Token"
            ));
        }
    } else {
        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "message" => "ข้อมูลไม่ครบ"
        ));
    }
}