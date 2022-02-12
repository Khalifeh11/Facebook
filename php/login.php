<?php
session_start();

include("db_info.php");

if(isset($_POST["email"])){
    $email = $mysqli->real_escape_string($_POST["email"]);
    
}else{
    die("Don't try to mess around bro ;)");
}

if(isset($_POST["password"])){
    $password = $mysqli->real_escape_string($_POST["password"]);
    $password = hash("sha256", $password);
}else{
    die("Don't try to mess around bro ;)");
}

// $email = "today@gmail.com";
// $password = hash("sha256", "helloworld");


$query = $mysqli->prepare("SELECT id FROM users WHERE email = ? AND password = ?");
$query->bind_param("ss", $email, $password);
$query->execute();


$query->store_result();
$num_rows = $query->num_rows;
$bind = $query->bind_result($id);
$assoc = $query->fetch();
$array_response = [];

if($num_rows == 0){
    $array_response["status"] = "User not found!";
}else{
    $array_response["status"] = "Logged In !";
    $_SESSION ["id"] = $id;
    $array_response["user_id"] = $id;
}

$json_response = json_encode($array_response);
echo $json_response;

$query->close();
$mysqli->close();

?>