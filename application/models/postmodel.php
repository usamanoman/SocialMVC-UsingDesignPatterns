<?php

class PostModel extends Model {

    
    
    function __construct($db){
        parent::__construct($db);
    }

    public function insert($data) {
        $post=addslashes($data['post']);
        $userid=$data['user_id'];
        $privacy=$data['privacy'];
        $sql = "INSERT INTO `posts`(`user_id`, `post_content`,  `privacy_level`) VALUES ('$userid','$post','$privacy')";
        $result = $this->db->execute($sql);
        return $result  ;
    }

    function lastPost(){
        $sql = "SELECT  id,privacy_level FROM `posts` order by id desc limit 1";
        return  $this->db->get_result($sql);
           
    }

    function getPosts(){
        $userid= $_SESSION['user_data']['id'];
        $sql = "SELECT * FROM posts p left join wall w on w.pid = p.id LEFT join users u on u.id=p.user_id  where w.uid='$userid'";
        return $this->db->get_results($sql);
        
    }


}
