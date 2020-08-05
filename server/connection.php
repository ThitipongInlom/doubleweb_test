<?php
date_default_timezone_set("Asia/Bangkok");

$servername = "localhost";
$username = "root";
$password = "";
$database = "doubleweb_test";

$sql_details = array(
  'user' => $username,
  'pass' => $password,
  'db'   => $database,
  'host' => $servername
);

$conn = new mysqli($servername, $username, $password, $database);
$conn->set_charset("utf8");

if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
