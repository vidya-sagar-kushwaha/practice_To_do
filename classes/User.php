<?php

class User{

    private $db;
    private $user_table = "users";

    // fields in 'users' table
    public $user_id;
    public $name;

    public function __construct($db)
    {

        $this->db = $db;
    }

    function read(){
        $sql = "select * from ".$this->user_table."  order by user_id ;";
        $result = $this->db->query($sql);
        return $result;
    }

    function read_one(){
        $sql = "select * from ".$this->user_table." where user_id = ".$this->user_id;
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();

        // set values to object properties

        $this->user_id = $row['user_id'];
        $this->name = $row['name'];

        if($result->num_rows > 0) return true;
        else return false;
    }

    function create(){
        $sql = "insert into ".$this->user_table."(name) values(\"".$this->name."\");";
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function update(){
        $sql = "update ".$this->user_table." set name = \"".$this->name."\" where user_id = ".$this->user_id;
        echo $sql;
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

    function delete(){
        $sql = "delete from ".$this->user_table." where user_id=".$this->user_id;
        $result = $this->db->query($sql);
        if($result){
            return true;
        }else
            return false;
    }

}