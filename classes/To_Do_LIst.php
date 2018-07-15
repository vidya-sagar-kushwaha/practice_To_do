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

}