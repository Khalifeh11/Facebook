<?php
session_start();

include("db_info.php");

$id1 = $_SESSION["id"];
$id2 = $_GET["id2"];
$is_pending = 0;

$query = $mysqli->prepare("UPDATE connections SET is_pending = ? WHERE user_id1=? AND user_id2=?"); 
$query->bind_param("ssi", $is_pending, $id1, $id2);
$query->execute();

$array_response = [];
$array_response["status"] = "Friend added!";

$json_response = json_encode($array_response);
echo $json_response;


?>