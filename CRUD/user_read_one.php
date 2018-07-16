<?php
/*
 * Read the user details, if user_id is supplied
 * Else, read all users details, order by user_id
 *
 * */
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// include database and object files
include_once '../config/connection.php';
include_once '../classes/User.php';

// instantiate connection and User object
$conn = new Connection();
$db = $conn->get_connection();

$user = new User($db);

// set user_id of User to be read. Here -1 indicates that user_id not supplied
$user->user_id = isset($_GET['user_id']) ? $_GET['user_id'] : -1;

// query User
if($user->user_id>=0) {
    $flag = $user->read_one();
    if($flag) {
        // create array
        $user_arr = array(
            "user_id" => $user->user_id,
            "name" => $user->name
        );
        // make it json format
        print_r(json_encode($user_arr));
    }else{
        echo json_encode(
            array("message" => "No user found.")
        );
    }
}else {
    // read all the users
    $stmt = $user->read();
    $num = $stmt->num_rows;
    // check if more than 0 record found
    if($num>0){
        // To_Do array
        $user_arr=array();
        $user_arr["records"]=array();

        // retrieve our table contents\
        while ($row = $stmt->fetch_assoc()){
            // extract rows...this will make $row['name'] to $name only
            extract($row);
            $user_item = array(
                "user_id" =>  $user_id,
                "name" => $name
            );
            array_push($user_arr["records"], $user_item);
        }
        print_r(json_encode($user_arr));
    }
    else{
        echo json_encode(
            array("message" => "No user found.")
        );
    }
}