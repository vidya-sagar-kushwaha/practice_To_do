<?php
class Connection
{
    public $db = null;
    public function get_connection()
    {
        if ($this->db == null) {
            // This is MultiUser branch
            $this->db = new mysqli('127.0.0.1:8889', 'root', 'root', 'To_Do_with_users');
            if ($this->db->connect_errno) {
                die('dying....!!');
            }
        }
        return $this->db;
    }
}
