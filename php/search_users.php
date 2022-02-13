<?php
include("db_info.php");

// $id = $_SESSION["id"];
$search = $_GET["key"];
$search_key = '%'. $search . '%';

$query = $mysqli->prepare("SELECT * FROM users where first_name like ? OR last_name like ?");

$query->bind_param("ss", $search_key, $search_key);
$query->execute();

$result = $query->get_result();
$users =[];

while($result_array = $result->fetch_assoc()){
    $users[] = $result_array;
}


$json = json_encode($users, JSON_PRETTY_PRINT);
echo($json);


?>




