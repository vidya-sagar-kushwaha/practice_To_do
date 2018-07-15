<?php
/*
 * update a list: Here user can update a list name, id, and hence cascade update all the tasks against that list
 * update a task in a list : give list_id + task id to identify and then new details to be set
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

// set this from the input from user(API),
$update_list = false; // TRUE: we updating the list details, false: we have to update task details

$given_list_id = 9;   // can not be null
$new_list_name = "Study";

$given_task_id = 30;
$new_task_name = "Learn PHP Today";
$new_task_status = "almost done";

// initialize object
$to_do_lists = new To_Do_List($db);

// query products
if($update_list==true)
    $stmt = $to_do_lists->update_list($given_list_id, $new_list_name);
else
    $stmt = $to_do_lists->update_task($given_list_id, $given_task_id, $new_task_name, $new_task_status);

