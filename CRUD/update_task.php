<?php
/*
 * update task details
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

$task = new Tasks($db);

// get id of product to be edited
$data = json_decode(file_get_contents("php://input"));

// set task_id of task to be updated
$task->user_id = $data->user_id;
$task->list_id = $data->list_id;
$task->task_id = $data->task_id;

// set task property values
$task->name = $data->name;
$task->status = $data->status;

// update the task
if($task->update()){
    echo '{';
    echo '"message": "Task was updated."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to update Task."';
    echo '}';
}
