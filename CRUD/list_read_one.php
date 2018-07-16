<?php
/*
 * Read the list details, if list_id is supplied
 * Else, read all the list details, order by list_id
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_List.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

$list = new To_Do_List($db);

// set ID property of list to be read. -1 indicates that list_id not supplied
$list->list_id = isset($_GET['list_id']) ? $_GET['list_id'] : -1;
$list->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : -1;

// query list
if($list->list_id>=0 && $list->user_id>=0) {
    $flag = $list->read_one();
    if($flag) {
        // create array
        $list_arr = array(
            "list_id" => $list->list_id,
            "user_id" => $list->user_id,
            "name" => $list->name,
            "updated_on" => $list->updated_on,
            "pending_tasks" => $list->pending_tasks
        );
        // make it json format
        print_r(json_encode($list_arr));
    }else{
        echo json_encode(
            array("message" => "No to_do lists found.")
        );
    }
}else {
    // read all the lists
    $stmt = $list->read();
    $num = $stmt->num_rows;
    // check if more than 0 record found
    if($num>0){
        // To_Do array
        $list_arr=array();
        $list_arr["records"]=array();

        // retrieve our table contents\
        while ($row = $stmt->fetch_assoc()){
            // extract rows...this will make $row['name'] to $name only
            extract($row);
            $list_item = array(
                "list_id" =>  $list_id,
                "user_id" =>  $user_id,
                "name" => $name,
                "updated_on" => $updated_on,
                "pending_tasks" => $pending_tasks
            );
            array_push($list_arr["records"], $list_item);
        }
        print_r(json_encode($list_arr));
    }
    else{
        echo json_encode(
            array("message" => "No to_do lists found.")
        );
    }
}