<?php

include("db_info.php");

$id = $_GET["id"];
$id = base64_decode($id);
$is_blocked = 0;
$is_pending = 0;

$query = $mysqli->prepare("SELECT user1_id FROM connections where (user2_id=?) AND is_blocked = ? AND is_pending = ?");


$query->bind_param("iii", $id, $is_blocked, $is_pending);
$query->execute();

$result1 = $query->get_result();
$friends1 =[];
while($result1_array = $result1->fetch_assoc()){
    $friends1[] = $result1_array;
}

$query2 = $mysqli->prepare("SELECT user2_id FROM connections where (user1_id=?) AND is_blocked = ? AND is_pending = ?");

$query2->bind_param("iii", $id, $is_blocked, $is_pending);
$query2->execute();

$result2 = $query2->get_result();
$friends2 =[];
while($result2_array = $result2->fetch_assoc()){
    $friends2[] = $result2_array;
}

$friends = array_merge($friends1, $friends2);   

$json = json_encode($friends, JSON_PRETTY_PRINT);
echo($json);

?>

