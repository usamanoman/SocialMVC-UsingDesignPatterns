<?php

class FriendsModel extends Model {

    /**
     * Validate user name
     * @param $name
     * @return int
     */
    
    function __construct($db){
        parent::__construct($db);
    }

    function add($id){
    	$uid = $_SESSION['user_data']['id'];
    	$fid = $id;
    	$sql = "SELECT  * from  `friends` where `uid`='$uid' AND  `fid`='$fid'";
        $result = $this->db->get_result($sql);
        if(count($result)==0){
    		$sql = "INSERT INTO `friends` (`uid`, `fid`) VALUES ('$uid','$fid')";
        	$result = $this->db->execute($sql);
        	return $result  ;
		}
        
    }


    function remove($id){
		$uid = $_SESSION['user_data']['id'];
    	$fid = $id;
    	$sql = "DELETE  from  `friends` where `uid`='$uid' AND  `fid`='$fid'";
        $result = $this->db->execute($sql);
        
    }

    function getFriendsList(){
    	$uid = $_SESSION['user_data']['id'];
    	$sql = "SELECT * FROM `users` LEFT JOIN friends f  ON f.fid = id where f.uid='$uid'";
    	return $this->db->get_results($sql);
    }
    
    
}
