<?php
require 'lib/view.php';
require 'lib/Subject.php';
require 'lib/PostObserver.php';

class Controller {

    
    public $db = null;
    public $controller_name = null;
    public $action_name = null;

    
    function __construct() {
        if (APP_DATABASE) {
            $this->db = new Database();        
        }

    }
    
    public function loadModel($model_name) {
        require 'application/models/' . strtolower($model_name) . '.php';
        return new $model_name($this->db);
    }

    public function redirect($url) {
        header('Location: ' . $url);
        exit();
    }

}
