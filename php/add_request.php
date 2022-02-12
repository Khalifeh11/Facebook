<?php
session_start();

include("db_info.php");

$id1 = $_SESSION["id"];
$id2 = $_GET["id2"];
$is_pending = 1;

$query = $mysqli->prepare("INSERT INTO connections (user1_id, user2_id, is_pending) VALUES (?,?,?)"); 
$query->bind_param("ssi", $id1, $id2, $is_pending);
$query->execute();

$array_response = [];
$array_response["status"] = "request sent";

$json_response = json_encode($array_response);
echo $json_response;


?>