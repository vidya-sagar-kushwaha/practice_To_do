<?php

class Tasks{

    private $db;
    // table names
    private $list_table = "to_do_lists";
    private $task_table = "tasks";


    // fields in 'tasks' table
    public $task_id;
    public $list_id;
    public $name;
    public $updated_on;
    public $status;

    public function __construct($db)
    {
        $this->db = $db;
    }

    function read(){
        $sql = "select * from ".$this->task_table." order by list_id ;";
        $result = $this->db->query($sql);
        return $result;
    }

    function read_one(){
        $sql = "select * from ".$this->task_table." where list_id = ".$this->list_id." and task_id = ".$this->task_id;
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        // set values to object properties
        $this->name = $row['name'];
        $this->updated_on = $row['updated_on'];
        $this->status = $row['status'];
        if($result->num_rows>0) return true;
        else return false;
    }

    function create(){
        $sql = "insert into ".$this->task_table."(list_id, name, status) values(".$this->list_id.",\"".$this->name."\",\"".$this->status."\");";
        $result = $this->db->query($sql);
        if($result){
            // increment the number of tasks for the list this task belongs
            $sql = "update ".$this->list_table." set pending_tasks = pending_tasks + 1 where list_id = ".$this->list_id;
            $this->db->query($sql);
            return true;
        }else
            return false;
    }

    function update(){
        $sql = "update ".$this->task_table." set name = \"".$this->name."\", status = \"".$this->status."\", updated_on = Now() where list_id = ".$this->list_id." and task_id = ".$this->task_id;
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function delete(){
        $sql = "delete from ".$this->task_table." where list_id=".$this->list_id." and task_id=".$this->task_id.";";
        $result = $this->db->query($sql);
        if($result){
            // decrement the number of tasks for the list to which this task belonged
            $sql = "update ".$this->list_table." set pending_tasks = pending_tasks - 1 where list_id = ".$this->list_id." and pending_tasks > 0";
            $this->db->query($sql);
            return true;
        }else
            return false;
    }

}