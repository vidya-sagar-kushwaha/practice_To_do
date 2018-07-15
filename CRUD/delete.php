<?php
/*
 * delete a list: Here user can delete a list, and hence cascade delete all the tasks against that list
 * delete a task in a list : give list_id + task id
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_List.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

// set this from the input from user(API), delete entire list if task_id is null.
$given_list_id =4;
$given_task_id = null;

// initialize object
$to_do_lists = new To_Do_List($db);

// delete
if($given_task_id==null)
    $stmt = $to_do_lists->delete_list($given_list_id);
else
    $stmt = $to_do_lists->delete_task($given_list_id, $given_task_id);

