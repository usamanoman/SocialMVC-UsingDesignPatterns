<?php

class UsersModel extends Model {

    /**
     * Validate user name
     * @param $name
     * @return int
     */
    
    function __construct($db){
        parent::__construct($db);
    }

    public function check($data) {
        $email=$data['email'];
        $password=md5($data['password']);
        $sql = "SELECT * FROM users WHERE email = '$email' AND password = '$password' ";
        $result = $this->db->get_result($sql);
        return  $result;
    }
    public function getWall($user_id){
        $sql = "SELECT * FROM posts p LEFT JOIN wall w=users u  WHERE (`w.uid` = `u.id` AND `p.pid`=`w.pid`) OR user_id='$user_id' ";
        $result = $this->db->get_result($sql);
        return  $result;
        
    }


    public function getList($user_id){
        $sql = "SELECT * FROM `users` where id != '$user_id' and id not in(select fid from friends where uid='$user_id')";
        $result = $this->db->get_results($sql);
        return $result ;

        
    }
    public function checkpassword($user_id,$curr_pass){
        $sql = "SELECT password FROM `users` where id = '$user_id'";
        $password = $this->db->get_result($sql);
        $curr_pass=md5($curr_pass);
        //echo "$curr_pass";
        //echo $password['password'] ;
        if($curr_pass==$password['password'])
            return (bool)(True);
        
    }
    public function update_pass($user_id,$curr_pass){
        $curr_pass = md5($curr_pass);
       $sql = "UPDATE users SET password='$curr_pass' where id = '$user_id'";
       $result=$this->db->execute($sql);
       return $result; 
    }
    

}
