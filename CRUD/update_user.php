<?php
/*
 * update user details
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/User.php';

// instantiate connection and User object, and set the user_id
$conn = new Connection();
$db = $conn->get_connection();

$user = new User($db);
$data = json_decode(file_get_contents("php://input"));

$user->user_id = $data->user_id;

// set user details
$user->name = $data->name;

// update the user
if($user->update()){
    echo '{';
    echo '"message": "User was updated."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to update User."';
    echo '}';
}
