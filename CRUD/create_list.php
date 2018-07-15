<?php
/*
 * Create a new list: Here user can create a new do_do_list, so need not give the list id
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

$list = new To_Do_List($db);

$list->name = $data->name;

if($list->create_list()) {
    echo '{';
    echo '"message": "List was created."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to create List."';
    echo '}';
}

