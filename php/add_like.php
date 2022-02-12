<?php
session_start();

include("db_info.php");

// $id1 = $_SESSION["id"];
$id1 = 1;
$id2 = $_GET["id2"];
$post_id = $_GET["post_id"];

$check_query = $mysqli->prepare("SELECT * FROM likes where user1_id=? AND user2_id=? AND post_id=?");
$check_query->bind_param("ssi", $id1, $id2, $post_id);
$check_query->execute();
$check_query->store_result();
$num_rows = $check_query->num_rows;
$check_query->fetch();

$array_response = [];

if ($num_rows == 0){
    $query = $mysqli->prepare("INSERT INTO likes (user1_id, user2_id, post_id) VALUES (?,?,?)"); 
    $query->bind_param("sss", $id1, $id2, $post_id);
    $query->execute();
    $query2 = $mysqli->prepare("UPDATE posts SET nb_of_likes = nb_of_likes + 1 where ID=?");
    $query2->bind_param("s", $post_id);
    $query2->execute();
    $array_response["status"] = "post liked";
}else{
    $query3 = $mysqli->prepare("DELETE from likes where user1_id=? AND user2_id=?  AND post_id=?"); 
    $query3->bind_param("sss", $id1, $id2, $post_id);
    $query3->execute();
    $query4 = $mysqli->prepare("UPDATE posts SET nb_of_likes = nb_of_likes - 1 where ID=?");
    $query4->bind_param("s", $post_id);
    $query4->execute();
    $array_response["status"] = "like removed";
}

$json_response = json_encode($array_response);
echo $json_response;



?>