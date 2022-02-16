<?php

include("db_info.php");

$id = $_GET["id"];
$id = base64_decode($id);
$is_blocked = 1;

$query = $mysqli->prepare("SELECT user1_id, user2_id FROM connections where (user1_id=? or user2_id =?) AND is_blocked = ?");

$query->bind_param("iii", $id, $id, $is_blocked);
$query->execute();

$result = $query->get_result();
$blocked =[];

while($result_array = $result->fetch_assoc()){
    $blocked[] = $result_array;
}

$json = json_encode($blocked, JSON_PRETTY_PRINT);
echo($json);

?>