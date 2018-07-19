<?php
/*
 * delete a list:
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

// get list id
$data = json_decode(file_get_contents("php://input"));

$list = new To_Do_List($db);
// set list id to be deleted
$list->list_id = $data->list_id;

// delete the list
if($list->delete()){
    echo '{';
    echo '"message": "list was deleted."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to delete List."';
    echo '}';
}