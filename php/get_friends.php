<?php

include("db_info.php");

// $id = $_SESSION["id"];
$id = $_GET["id"];
$id = base64_decode($id);
$is_blocked = 0;
$is_pending = 0;

$query = $mysqli->prepare("SELECT user1_id, user2_id FROM connections where user1_id=? or user2_id =? AND is_blocked = ? AND is_pending = ?");

$query->bind_param("iiii", $id, $id, $is_blocked, $is_pending);
$query->execute();

$result = $query->get_result();
$friends =[];
while($result_array = $result->fetch_assoc()){
    $friends[] = $result_array;
}

$json = json_encode($friends, JSON_PRETTY_PRINT);
echo($json);

?>