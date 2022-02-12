<?php
session_start();

include("db_info.php");

$id = $_SESSION["id"];
$text = $_GET["text"];

$query = $mysqli->prepare("INSERT INTO posts (`Post_content`, `User_ID`) values(?,?)");
$query->bind_param("ss", $text, $id);
$query->execute();

$array_response = [];
$array_response["status"] = "post sent";
$json_response = json_encode($array_response);
echo $json_response;
?>