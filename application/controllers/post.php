<?php

require 'application/controllers/facade.php';
class Post  extends Controller{


	function new_post(){
		$data=array(
			'privacy' => $_POST['privacy'],
			'post' => $_POST['post'],
			'user_id' => $_SESSION['user_data']['id']
			);

		$postmodel = new facade($data);
		$postmodel->post($data);
		

        $this->redirect('../user/dashboard');
			
	}

}

