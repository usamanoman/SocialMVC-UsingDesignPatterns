<?php

require 'update.php';
interface PostObserver
{
	public function updateObserver($content,$database);
	public function updatePassword($data); 	
}

class PublicPostObserver implements  PostObserver
{

	public function updateObserver($post_content,$database)
	{
		$sql="select * from users";
		$result=$database->get_results($sql);
		$sql=$this->prepSQL($result,$post_content);
		$database->execute($sql);
	}	

	private function prepSQL($result,$post_content){
		$sql = "INSERT INTO wall VALUES ";
		$sql = $sql . substr($this->setWallPost($result,$post_content), 0,strlen($this->setWallPost($result,$post_content))-1);
		return $sql;
	}
	public function updatePassword($data){
		throw new Exception("Unsupport ", 1);
		
	}

	private function setWallPost($result,$post_content){
		$generated="";
		foreach($result as $SingleRow){
			$uid=$SingleRow['id'];
			$generated .= "( $uid , $post_content ),";
		}
		return $generated;
	}
}

class FriendsObserver implements PostObserver
{
	public function updateObserver($post_content,$database)
	{
		$cur_uid = $_SESSION['user_data']['id'];
		$sql="select fid from friends where uid = $cur_uid";
		$result=$database->get_results($sql);
		$sql=$this->prepSQL($result,$post_content,$cur_uid);
		$database->execute($sql);
	}

	private function prepSQL($result,$post_content,$cur_uid){
		$sql = "INSERT INTO wall VALUES ";
		$sql = $sql . substr($this->setWallPost($result,$post_content,$cur_uid), 0,strlen($this->setWallPost($result,$post_content,$cur_uid))-1);
		return $sql;
	}

	public function updatePassword($data){
		throw new Exception("Unsupport ", 1);
		
	}

	private function setWallPost($result,$post_content,$cur_uid){
		$generated="";
		foreach($result as $SingleRow){
			$uid=$SingleRow['fid'];
			$generated .= "( $uid , $post_content ),";
		}
		$generated .= "( $cur_uid , $post_content )," ;
		return $generated;
	}	
}

class PasswordAlertAdaptor implements PostObserver{
	public function updatePassword($data){
		$passnotifier = new PasswordNotifier(); 
		$passnotifier->update_password($data);
	}
	public function updateObserver($post_content,$database){
		throw new Exception("Unsupport operation exception", 1);
		
	}
}




