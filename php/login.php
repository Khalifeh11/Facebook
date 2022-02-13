<?php
header("Access-Control-Allow-Origin: *");
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

$query = $mysqli->prepare("SELECT * FROM users WHERE email = ? AND password = ?");
$query->bind_param("ss", $email, $password);
$query->execute();

$result = $query->get_result();
$row = $result->fetch_assoc();

$array_response = [];

if(!$row){
    $array_response["status"] = "User not found!";
}else{
    $id = $row["id"];
    $id_encode = base64_encode($id);
    $array_response["status"] = "Logged In !";
    $array_response["user_id"] = $id_encode;
    $array_response["first_name"] = $row["first_name"];
    $array_response["last_name"] = $row["last_name"];
}

$json_response = json_encode($array_response);
echo $json_response;

$query->close();
$mysqli->close();

?>