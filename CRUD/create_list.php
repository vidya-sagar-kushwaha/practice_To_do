<?php
/*
 * Create a new list
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_List.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

// get posted data
$data = json_decode(file_get_contents("php://input"));

//create and populate the object. It will be used in sql query
$list = new To_Do_List($db);
$list->user_id = $data->user_id;
$list->name = $data->name;

if($list->create()) {
    echo '{';
    echo '"message": "List was created."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to create List."';
    echo '}';
}

