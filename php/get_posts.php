<?php


session_start();

include("db_info.php");

$id = $_POST["id"];
// $id = base64_decode($id);


// $query = $mysqli->prepare("SELECT DISTINCT(p.ID), p.Post_content, p.nb_of_likes, p.nb_of_dislikes, p.User_ID, p.post_time FROM posts p, connections c WHERE (p.User_ID = c.user1_id OR p.User_ID = c.user2_id) AND is_blocked = 0 AND is_pending = 0 AND (user1_id = ? OR user2_id = ?) ORDER BY post_time desc");

$query = $mysqli->prepare("SELECT * from posts WHERE User_ID =? 
or (
    User_ID IN (SELECT user1_id from connections WHERE (user2_id=? or user1_id=?) and is_blocked <> 1 and is_pending <> 1)
    )
or (
    User_ID IN (SELECT user2_id from connections WHERE (user2_id=? or user1_id=?) and is_blocked <> 1 and is_pending <> 1)
    )");

// 2 3 4 22
$query->bind_param("sssss", $id,$id,$id,$id,$id);
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