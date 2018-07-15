<?php

/*
 * Read a task
 * */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/connection.php';
include_once '../classes/Tasks.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

$task = new Tasks($db);

// set task id to be read. -1 indicates that value has not been supplied
$task->list_id = isset($_GET['list_id']) ? $_GET['list_id'] : -1;
$task->task_id = isset($_GET['task_id']) ? $_GET['task_id'] : -1;


// query task
if($task->list_id>=0 && $task->task_id>=0) {
    // list_id and task_id given.
    $stmt = $task->read_one();
    // create array
    $task_arr = array(
        "task_id" =>  $task->task_id,
        "list_id" =>  $task->list_id,
        "name" => $task->name,
        "updated_on" => $task->updated_on,
        "status" => $task->status
    );

    // make it json format
    print_r(json_encode($task_arr));
}else {
    // Show all tasks, order by list_id
    $stmt = $task->read();
    $num = $stmt->num_rows;
    // check if more than 0 record found
    if($num>0){
        // To_Do array
        $task_arr=array();
        $task_arr["records"]=array();

        // retrieve our table contents\
        while ($row = $stmt->fetch_assoc()){
            // extract rows
            // this will make $row['name'] to
            // just $name only
            extract($row);
            $task_item = array(
                "task_id" =>  $row['task_id'],
                "list_id" =>  $row['list_id'],
                "name" => $row['name'],
                "updated_on" => $row['updated_on'],
                "status" => $row['status']
            );
            array_push($task_arr["records"], $task_item);
        }
        print_r(json_encode($task_arr));
    }
    else{
        echo json_encode(
            array("message" => "No Task found.")
        );
    }
}