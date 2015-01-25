<?php
require 'application/controllers/facade.php';
require_once $_SERVER['DOCUMENT_ROOT'] . "/social-master/lib/postObserver.php";

class User extends Controller {




    function dashboard(){
        
        $homePage = new View("user/dashboard.php");
        $data = $_SESSION['user_data'];
        $load_Model = new facade($data); 
        $model_list=$load_Model->load_model();
        $load_Model->get_list($data,$model_list);
        $homePage->make($data);
    }


    function login(){
        $data=array(
            'email'=>$_POST['email'],
            'password'=>$_POST['password']
            );
        $user_model = $this->loadModel('UsersModel');
        $result=$user_model->check($data);
        if(count($result)>0){
            $_SESSION['user_data']=$result;
            $this->redirect('dashboard');    
        }
        else{
            $this->redirect('../');
        }
        
    }
    function update(){
        $id = $_SESSION['user_data'];
        $data=array(
             'oldpass' => $_POST['oldpass'],
             'newpass' => $_POST['newpass'],
             'id' =>    $id['id']
            );
        $Adapter = new PasswordAlertAdaptor();
        $result=$Adapter->updatePassword($data);
        if ($result) {
             $this->redirect('dashboard');
        }                    
    }

    function logout(){
        session_unset(); 
        session_destroy(); 
        $this->redirect('../');
    }
}
?>