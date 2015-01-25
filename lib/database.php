<?php

class Database {

    function __construct()
    {
        $this->mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        if($this->mysqli->connect_errno){
            die("Error Occured in connection");
        }
        
    }
    
    function get_result($sql){
        $result = $this->mysqli->query($sql);
        return $result->fetch_array(MYSQLI_ASSOC);
    }

    function get_results($sql){
        $result = $this->mysqli->query($sql);
        $row = array();
        while($row[] = $result->fetch_array(MYSQLI_ASSOC)){ }
        unset($row[count($row)-1]);
        return $row;
    }

    function execute($sql){
        return  $this->mysqli->query($sql);
    }

}


