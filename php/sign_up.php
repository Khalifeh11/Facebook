<?php

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

if(isset($_POST["first_name"])){
    $first_name = $mysqli->real_escape_string($_POST["first_name"]);
}else{
    die("Don't try to mess around bro ;)");
}

if(isset($_POST["last_name"])){
    $last_name = $mysqli->real_escape_string($_POST["last_name"]);
}else{
    die("Don't try to mess around bro ;)");
}

// check if user exists in our database 
$check_query = $mysqli->prepare("SELECT * FROM users where email=?");
$check_query->bind_param("s", $email);
$check_query->execute();
$check_query->store_result();
$num_rows = $check_query->num_rows;
$check_query->fetch();

// if user doesnt exist insert sign up info into our table else return response user already exists 
if($num_rows == 0){
    $sign_up_query = $mysqli->prepare("INSERT INTO users (`first_name`, `last_name`, `email`, `password`) VALUES (?, ?, ?, ?)");
    $sign_up_query->bind_param("ssss", $first_name, $last_name, $email, $password);
    $sign_up_query->execute();
    $sign_up_query->store_result();
    $sign_up_query->fetch();
    $array_response = [];
    $user_info = [];
    $array_response["status"] = "success";
    $user_info["first_name"] = $first_name;
    $user_info["last_name"] = $last_name;
    $user_info["email"] = $email;
    $user_info["password"] = $password;
    
    $json_response = json_encode($array_response);
    $json_user_info = json_encode($user_info);
    echo $json_response;
    echo $json_user_info;
    $sign_up_query->close();
    $mysqli->close();
}else{
    $array_response["status"] = "user already exists";
    $json_response = json_encode($array_response);
    echo $json_response;
    $mysqli->close();
}

 


 
?>