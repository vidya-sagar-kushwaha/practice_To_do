<?php
/*
 * Create a new list: Here user can create a new do_do_list, so need not give the list id
 * create a task in an existing list : give list_id + task details to insert
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


// set this from the input from user(API), if list_id is NULL--> we create a new list..else a new task under that list_ID
$given_list_id = 9;
$given_list_name = "hello";
$given_task_name = "C++";
$given_task_status = "in progress";

// initialize object
$to_do_lists = new To_Do_List($db);

// query products
if($given_list_id==null)
    $stmt = $to_do_lists->create_list($given_list_name);
else
    $stmt = $to_do_lists->create_task($given_list_id, $given_task_name, $given_task_status);

