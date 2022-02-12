<?php
session_start();

include("db_info.php");

$id1 = $_GET["id2"];
$id2 = $_SESSION["id"];
$is_pending = 0;

$query = $mysqli->prepare("UPDATE connections SET is_pending = ? WHERE user1_id=? AND user2_id=?"); 
$query->bind_param("iss", $is_pending, $id1, $id2);
$query->execute();

$array_response = [];
$array_response["status"] = "Friend added!";

$json_response = json_encode($array_response);
echo $json_response;


?>