<?php

include_once 'config/connection.php';

$conn = new Connection();
$db = $conn->get_connection();

$result = $db->query("select * from to_do_lists;");
echo "Rows : ".$result->num_rows."<br>";


