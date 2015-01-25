<?php
require_once $_SERVER['DOCUMENT_ROOT'] . "/social-master/lib/controller.php";

class facade{
	
	function &load_model(){
                $model=$this->loadControllers();
                if(isset($model)){        
        	       return $model;
                }
	}

        function loadControllers(){
                $controller = new controller();
                $user_model = $controller->loadModel('UsersModel');
                $friend_model = $controller->loadModel('FriendsModel');
                $post_model = $controller->loadModel('PostModel');
                $model_list = array('usermodel' => $user_model,
                        'friendmodel' =>$friend_model,
                        'postmodel' => $post_model
                );
                return $model_list;
        }


	function get_list(&$data,&$model_list){
		$data['friends']=$model_list['friendmodel']->getFriendsList();
		$data['users'] = $model_list['usermodel']->getList($data['id']);
	        $data['posts'] = $model_list['postmodel']->getPosts();
                
	}

        function post(&$data){
                $controller = new controller();
                $post_model = $controller->loadModel('PostModel');
                $result=$this->getLastPostID($data,$post_model);
                $this->redirectBasedOnPrivacy($result['privacy_level'],$result['id'],$controller);                
                
        }

        private function getLastPostID($data,$post_model){
                $result=$post_model->insert($data);
                $result=$post_model->lastPost();
                return $result;
        }

        private function redirectBasedOnPrivacy($privacy_level,$id,$controller){
                if($privacy_level==0){
                        $controller->redirect('../friends/notifyPublic/'.$id);
                }
                else if($privacy_level==1){
                        $controller->redirect('../friends/notifyFriends/'.$id);
                }
        }
}




?>