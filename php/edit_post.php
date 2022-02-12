<?php
session_start();

include("db_info.php");

// $id = $_SESSION["id"];
$id = 1;
$text = $_GET["text"];
$post_id = $_GET["post_id"];


$query = $mysqli->prepare("UPDATE posts SET Post_content=? WHERE User_ID=? AND ID=?");
$query->bind_param("sss", $text, $id, $post_id);
$query->execute();

$array_response = [];
$array_response["status"] = "post updated";
$json_response = json_encode($array_response);
echo $json_response;

?>