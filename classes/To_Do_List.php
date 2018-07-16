<?php

class To_Do_List{

    private $db;
    private $list_table = "to_do_lists";
    //private $task_table = "tasks";


    // fields in 'to_do_lists' table
    public $list_id;
    public $name;
    public $updated_on;
    public $pending_tasks;

    public function __construct($db)
    {

        $this->db = $db;
    }

    function read(){
        $sql = "select * from ".$this->list_table."  order by list_id ;";
        $result = $this->db->query($sql);
        return $result;
    }

    function read_one(){
        $sql = "select * from ".$this->list_table." where list_id = ".$this->list_id;
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        // set values to object properties

        $this->list_id = $row['list_id'];
        $this->name = $row['name'];
        $this->updated_on = $row['updated_on'];
        $this->pending_tasks = $row['pending_tasks'];
    }

    function create(){
        $sql = "insert into ".$this->list_table."(name) values(\"".$this->name."\");";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function update(){
        $sql = "update ".$this->list_table." set name = \"".$this->name."\", updated_on = Now() where list_id = ".$this->list_id;
        echo $sql;
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function delete(){
        $sql = "delete from ".$this->list_table." where list_id=".$this->list_id;
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

}