<?php

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// include database and object files
include_once '../config/connection.php';
include_once '../classes/To_Do_LIst.php';

// instantiate connection and to_do_lists object
$conn = new Connection();
$db = $conn->get_connection();

// initialize object
$to_do_lists = new To_Do_LIst($db);

// query products
$stmt = $to_do_lists->read();
$num = $stmt->num_rows;


echo "Rows in READ.PHP : ".$num;

// check if more than 0 record found
if($num>0){

    // products array
    $to_do_lists_arr=array();
    $to_do_lists_arr["records"]=array();

    // retrieve our table contents
    // fetch() is faster than fetchAll()
    // http://stackoverflow.com/questions/2770630/pdofetchall-vs-pdofetch-in-a-loop

    while ($row = $stmt->fetch_assoc()){
        // extract row
        // this will make $row['name'] to
        // just $name only
        extract($row);

        $to_do_lists_item=array(
            "list_id" => $list_id,
            "name" => $name,
            "created_on" => $created_on,
            "pending_tasks" => $pending_tasks
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

