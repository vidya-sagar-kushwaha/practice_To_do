<?php
/*
 * delete a task:
 * */


header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/Tasks.php';

// instantiate connection and Tasks object
$conn = new Connection();
$db = $conn->get_connection();

// get task id
$data = json_decode(file_get_contents("php://input"));

$task = new Tasks($db);
// set task id to be deleted
$task->list_id = $data->list_id;
$task->task_id = $data->task_id;

// delete the task
if($task->delete()){
    echo '{';
    echo '"message": "task was deleted."';
    echo '}';
}
else{
    echo '{';
    echo '"message": "Unable to delete Task."';
    echo '}';
}