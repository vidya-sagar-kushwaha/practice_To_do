<?php

class To_Do_LIst{

    private $db;
    private $list_table = "to_do_lists";
    private $task_table = "tasks";


    // fields in 'to_do_lists' table
    public $list_id;
    public $name;
    public $created_on;
    public $pending_tasks;

    public function __construct($db)
    {

        $this->db = $db;
    }

    function read($list_id, $task_id){
        //if(isset($list_id)) echo "-------------------";
        if($list_id!=null) {
            if($task_id !=null)
                $sql = "select task_id, name, created_on, status from " . $this->task_table . " where list_id=" . $list_id . " and task_id=".$task_id.";";
            else
                $sql = "select task_id, name, created_on, status from " . $this->task_table . " where list_id=" . $list_id .";";

        }else
            $sql = "select * from ".$this->task_table."  order by list_id ;";
        $result = $this->db->query($sql);
        return $result;
    }

    function create_list($name){
        $sql = "insert into ".$this->list_table."(name) values(\"".$name."\");";
        $result = $this->db->query($sql);
        if($result){
            echo "successfully added a new list <br>";
        }else
            echo "Failed to add a new list..:((";
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
        $sql = "update ".$this->list_table." set name = ".$new_name." where list_id = ".$list_id;
        echo "<br> ".$sql;
        $result = $this->db->query($sql);
        if($result){
            echo "<br>successfully updated the list details <br>";
        }else
            echo "<br>Failed to delete the list details..:((";
    }


    function update_task($list_id, $task_id, $new_name, $new_status){
        $sql = "update ".$this->task_table." set name = \"".$new_name."\", status = \"".$new_status."\" where list_id = ".$list_id." and task_id = ".$task_id;
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