<?php

class To_Do_LIst{

    private $db;
    private $table_name = "to_do_lists";


    // fields in 'to_do_lists' table
    public $list_id;
    public $name;
    public $created_on;
    public $pending_tasks;

    public function __construct($db)
    {

        $this->db = $db;
    }

    function read(){
        $sql = "select * from ".$this->table_name.";";
        $result = $this->db->query($sql);
        return $result;
    }

}