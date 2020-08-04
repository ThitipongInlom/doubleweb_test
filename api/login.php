<?php
ini_set("display_errors", 1);
// include vendor
require '../vendor/autoload.php';

use \Firebase\JWT\JWT;
//include headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-type: application/json; charset=utf-8");

// including files
include_once("../server/connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $data = json_decode(file_get_contents("php://input"));

    if (!empty($data->username) && !empty($data->password)) {
        $mysqli_login = "SELECT player_id,player_username, player_password FROM _member WHERE player_username = '$data->username'";
        if ($result = $conn->query($mysqli_login)) {
            while ($obj = $result->fetch_object()) {
                $player_id   = $obj->player_id;
                $username_db = $obj->player_username;
                $password_db = $obj->player_password;
            }
            $result->free_result();
        }

        if (!empty($username_db)) {
            if (password_verify($data->password, $password_db)) {
                $iss = "localhost";
                $iat = time();
                $nbf = $iat + 5;
                $exp = $iat + 86400;
                $aud = "myusers";
                $user_arr_data = array(
                    "id" => $player_id,
                    "username" => $username_db,
                );

                $secret_key = "owt125";

                $payload_info = array(
                    "iss" => $iss,
                    "iat" => $iat,
                    "nbf" => $nbf,
                    "exp" => $exp,
                    "aud" => $aud,
                    "data" => $user_arr_data
                );

                $jwt = JWT::encode($payload_info, $secret_key, 'HS512');

                // ล็อกอินสำเร็จ
                http_response_code(200);
                echo json_encode(array(
                    "status" => 1,
                    "jwt" => $jwt,
                    "message" => "ล็อกอิน สำเร็จ"
                ));

                $_SERVER['Authorization'] = $jwt;
            }else {
                // Password ไม่ถูกต้อง
                http_response_code(404);
                echo json_encode(array(
                    "status" => 0,
                    "message" => "Password ไม่ถูกต้อง"
                ));              
            }           
        }else {
            // Username ไม่ถูกต้อง
            http_response_code(404);
            echo json_encode(array(
                "status" => 0,
                "message" => "ไม่พบ Username นี้"
            ));
        }
    } else {
        // ไม่พบ Username และ Password
        http_response_code(404);
        echo json_encode(array(
            "status" => 0,
            "message" => "ใส่ Username และ Password"
        ));
    }
}
