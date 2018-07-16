<?php
/*
 * Create a new user
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

// instantiate connection
$conn = new Connection();
$db = $conn->get_connection();

// get posted data
$data = json_decode(file_get_contents("php://input"));

//create and populate the User. It will be used in sql query
$user = new User($db);
$user->name = $data->name;

if($user->create()) {
    echo '{';
    echo '"message": "User was created."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to create User."';
    echo '}';
}

