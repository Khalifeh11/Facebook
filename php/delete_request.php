<?php
session_start();

include("db_info.php");

$id1 = $_GET["id1"];
$id2 = $_SESSION["id"];

$query = $mysqli->prepare("DELETE FROM connections where user1_id=? AND user2_id=?"); 
$query->bind_param("si", $id1, $id2);
$query->execute();

$array_response = [];
$array_response["status"] = "Request deleted!";

$json_response = json_encode($array_response);
echo $json_response;


?>