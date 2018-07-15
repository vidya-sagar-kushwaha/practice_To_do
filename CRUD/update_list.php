<?php
/*
 * update a list details
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

$list = new To_Do_List($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set ID property of list to be edited
$list->list_id = $data->list_id;

// set list property values
$list->name = $data->name;

// update the product
if($list->update()){
    echo '{';
    echo '"message": "List was updated."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to update list."';
    echo '}';
}
