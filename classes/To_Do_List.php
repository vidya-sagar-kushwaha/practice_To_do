<?php

class To_Do_List{

    private $db;
    private $list_table = "to_do_lists";
    private $task_table = "tasks";


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

    function create_list(){
        $sql = "insert into ".$this->list_table."(name) values(\"".$this->name."\");";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function create_task($list_id, $task_name, $status){
        $sql = "insert into ".$this->task_table."(list_id, name, status) values(".$list_id.",\"".$task_name."\",\"".$status."\");";

        $result = $this->db->query($sql);
        if($result){
            echo "successfully added a new task <br>";
            $sql = "update ".$this->list_table." set pending_tasks = pending_tasks + 1 where list_id = ".$list_id;
            $this->db->query($sql);

        }else
            echo "<br>Failed to add a new task..:((";
    }


    function update_list($list_id, $new_name){
        $sql = "update ".$this->list_table." set name = \"".$new_name."\", created_on = Now() where list_id = ".$list_id;
        echo "<br> ".$sql;
        $result = $this->db->query($sql);
        if($result){
            echo "<br>successfully updated the list details <br>";
        }else
            echo "<br>Failed to update the list details..:((";
    }


    function update_task($list_id, $task_id, $new_name, $new_status){
        $sql = "update ".$this->task_table." set name = \"".$new_name."\", status = \"".$new_status."\", created_on = Now() where list_id = ".$list_id." and task_id = ".$task_id;
        $result = $this->db->query($sql);
        if($result){
            echo "<br>successfully updated the task details <br>";
        }else
            echo "<br>Failed to update the task details..:((";
    }


    function delete_list($list_id){
        $sql = "delete from ".$this->list_table." where list_id=".$list_id.";";
        $result = $this->db->query($sql);
        if($result){
            echo "<br>successfully deleted the list <br>";
        }else
            echo "<br>Failed to delete the list..:((";
    }


    function delete_task($list_id, $task_id){
        $sql = "delete from ".$this->task_table." where list_id=".$list_id." and task_id=".$task_id.";";
        $result = $this->db->query($sql);
        if($result){
            echo "<br>successfully deleted the task <br>";
            $sql = "update ".$this->list_table." set pending_tasks = pending_tasks - 1 where list_id = ".$list_id." and pending_tasks > 0";
            $this->db->query($sql);
        }else
            echo "<br>Failed to delete the task..:((";
    }

}