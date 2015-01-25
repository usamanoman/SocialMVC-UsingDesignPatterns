<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/social-master/lib/controller.php";
interface update{
	function update_password($data);
}

class PasswordNotifier extends controller implements update {

	function update_password($data){
		$user_model = $this->loadModel('UsersModel');
		if($user_model->checkpassword($data['id'],$data['oldpass'])==(bool)true ){
			$result = $user_model->update_pass($data['id'],$data['newpass']);
			$this->updateNewPassword($result);	
		}
		else{
			$this->failedRedirection();		
		}
	}

	private function updateNewPassword($result){
		if(isset($result)){
			setcookie("notification", "Your Password has been Updated", time()+10);  
            $this->redirect('../user/dashboard');
		}
		else{
			setcookie("notification", "Something went wrong, please try again", time()+10);  
            $this->redirect('../user/dashboard');
		}
	}
	
	private function failedRedirection(){
		setcookie("notification", "Your previous password was wrong, couldn't update password.", time()+10);  
        $this->redirect('../user/dashboard');
	}

}


?>