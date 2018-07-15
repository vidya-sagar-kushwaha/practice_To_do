<?php
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

// set ID property of product to be edited
$list->list_id = isset($_GET['list_id']) ? $_GET['list_id'] : -1;

// query products
if($list->list_id>=0) {
    $stmt = $list->read_one();
    // create array
    $list_arr = array(
        "list_id" =>  $list->list_id,
        "name" => $list->name,
        "updated_on" => $list->updated_on,
        "pending_tasks" => $list->pending_tasks
    );

    // make it json format
    print_r(json_encode($list_arr));
}else {

    $stmt = $list->read();
    $num = $stmt->num_rows;
    // check if more than 0 record found
    if($num>0){
        // To_Do array
        $list_arr=array();
        $list_arr["records"]=array();

        // retrieve our table contents\
        while ($row = $stmt->fetch_assoc()){
            // extract rows
            // this will make $row['name'] to
            // just $name only
            extract($row);
            $list_item = array(
                "list_id" =>  $row['list_id'],
                "name" => $row['name'],
                "updated_on" => $row['updated_on'],
                "pending_tasks" => $row['pending_tasks']
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