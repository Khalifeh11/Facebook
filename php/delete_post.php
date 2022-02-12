<?php
session_start();

include("db_info.php");

// $id = $_SESSION["id"];
$id = 1;
$post_id = $_GET["post_id"];


$query = $mysqli->prepare("DELETE FROM posts WHERE ID=? AND User_ID=?");
$query->bind_param("ss", $post_id, $id);
$query->execute();

$array_response = [];
$array_response["status"] = "post deleted";
$json_response = json_encode($array_response);
echo $json_response;
?>