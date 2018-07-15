<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_List.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

// initialize object
$to_do_lists = new To_Do_List($db);

// query products
$stmt = $to_do_lists->read($given_list_id, $given_task_id);
$num = $stmt->num_rows;


echo "Rows in READ.PHP : ".$num."<br>";

// check if more than 0 record found
if($num>0){

    // To_Do array
    $to_do_lists_arr=array();
    $to_do_lists_arr["records"]=array();

    // retrieve our table contents

    while ($row = $stmt->fetch_assoc()){
        // extract rowå
        // this will make $row['name'] to
        // just $name only
        extract($row);
        $to_do_lists_item = array(
                "task_id" => $task_id,
                "list_id" => $list_id,
                "name" => $name,
                "created_on" => $created_on,
                "status" => $status
         );
        array_push($to_do_lists_arr["records"], $to_do_lists_item);
    }

    echo json_encode($to_do_lists_arr);
}

else{
    echo json_encode(
        array("message" => "No to_do lists found.")
    );
}

