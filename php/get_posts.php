<?php


session_start();

include("db_info.php");

$id = $_POST["id"];


$query = $mysqli->prepare("SELECT DISTINCT(p.ID), p.Post_content, p.nb_of_likes, p.nb_of_dislikes, p.User_ID, p.post_time FROM posts p, connections c WHERE (p.User_ID = c.user1_id OR p.User_ID = c.user2_id) AND is_blocked = 0 AND is_pending = 0 AND (user1_id = ? OR user2_id = ?)");


$query->bind_param("ss", $id,$id);
$query->execute();

$result = $query->get_result();

$connections = [];

while($connection1 = $result->fetch_assoc()){
    $connections[] = $connection1;
}


// $array_response["posts"] = $connections;
$json_response = json_encode($connections);
echo $json_response;

?>