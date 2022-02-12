<?php

include("db_info.php");

// $id = $_SESSION["id"];
$id = 1;

$query = $mysqli->prepare("SELECT user2_id FROM connections where user1_id=?");
$query->bind_param("i", $id);
$query->execute();

$result = $query->get_result();
$friends =[];
while($result_array = $result->fetch_assoc()){
    $friends[] = $result_array;
}

$json = json_encode($friends, JSON_PRETTY_PRINT);
echo($json);

?>