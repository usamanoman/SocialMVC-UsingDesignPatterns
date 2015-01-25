<?php

//include "lib/PostObserver.php";

class Friends  extends Controller implements Subject{
	

	function registerObserver($id){
		
        $friend_model = $this->loadModel('FriendsModel');
		$friend_model->add($id);
		$this->redirect('../../user/dashboard');
		
	}


	function removeObserver($id){
		$friend_model = $this->loadModel('FriendsModel');
		$friend_model->remove($id);
		$this->redirect('../../user/dashboard');
	}

	function notifyFriends($id){

		$friendsObserver = new FriendsObserver();
		$friendsObserver->updateObserver($id,$this->db);
		$this->redirect('../../user/dashboard');	
	
	}

	function notifyPublic($id){
		$publicObserver = new PublicPostObserver();
		$publicObserver->updateObserver($id,$this->db);
		$this->redirect('../../user/dashboard');
	}

}

