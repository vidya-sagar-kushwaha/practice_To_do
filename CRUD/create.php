<?php
/*
 * Create a new list: Here user can create a new do_do_list, so need not give the list id
 * create a task in an existing list : give list_id + task details to insert
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_LIst.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

// set this from the input from user(API), if list_id is NULL--> we create a new list..else a new task under that list_ID
$given_list_id = 9;
$given_list_name = "hello";
$given_task_name = "PHP";
$given_task_status = "in progress";

// initialize object
$to_do_lists = new To_Do_LIst($db);

// query products
if($given_list_id==null)
    $stmt = $to_do_lists->create_list($given_list_name);
else
    $stmt = $to_do_lists->create_task($given_list_id, $given_task_name, $given_task_status);

