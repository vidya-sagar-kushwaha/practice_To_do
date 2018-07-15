<?php
/*
 * Create a new task
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");


// include database and object files
include_once '../config/connection.php';
include_once '../classes/Tasks.php';

// instantiate connection and Task object
$conn = new Connection();
$db = $conn->get_connection();

// get posted data
$data = json_decode(file_get_contents("php://input"));

$task = new Tasks($db);

//populate the object
$task->list_id = $data->list_id;
$task->name = $data->name;
$task->status = $data->status;

if($task->create()) {
    echo '{';
    echo '"message": "Task was created."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to create Task."';
    echo '}';
}

