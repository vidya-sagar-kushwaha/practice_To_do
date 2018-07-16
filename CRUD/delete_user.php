<?php
/*
 * delete a user:
 * */


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/User.php';

// instantiate connection
$conn = new Connection();
$db = $conn->get_connection();

// get user id
$data = json_decode(file_get_contents("php://input"));

// create user object and set the id
$user = new User($db);
$user->user_id = $data->user_id;

// delete the user
if($user->delete()){
    echo '{';
    echo '"message": "User was deleted."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to delete User."';
    echo '}';
}