<?php

class Application {

    private $controllers_dir = './application/controllers/';

    private $controller = null;

    private $controller_name = null;

    private $action_name = null;

    private $parameters = array();

    private $site_subdir = null;

    private $subdirectories = array();

    public function __construct() {
        $this->splitUrl();
        $this->setControllerAndAction();
        $this->controller->controller_name = $this->controller_name;
        $this->controller->action_name = $this->action_name;
        call_user_func_array(array($this->controller, $this->action_name), $this->parameters);
    }

    private function setControllerAndAction(){
        if (file_exists($this->controllers_dir . $this->controller_name . '.php')) {
            require $this->controllers_dir . $this->controller_name . '.php';
            
            if (class_exists($this->controller_name)) {
                $this->controller = new $this->controller_name();
                if (!method_exists($this->controller, $this->action_name)) {
                    $this->action_name = 'index';
                }
            } else {
                require $this->controllers_dir . 'home.php';
                $this->controller_name = 'home';
                $this->action_name = 'index';
            }
            $this->controller = new $this->controller_name();
        } else {
            require $this->controllers_dir . 'home.php';
            $this->controller = new Home();
            $this->controller_name = 'home';
            $this->action_name = 'index';
        }
    }

    private function subdir() {
        return implode('/', $this->subdirectories) . '/';
    }

    private function splitUrl() {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url=$this->getUrlPartsArray($_SERVER['REQUEST_URI']);
            $this->putPartsIntoAccordingProperties($url);
        }
    }
    private function getUrlPartsArray($url){
        $url = rtrim($url, '/');
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return explode('/', $url);
    }


    private function putPartsIntoAccordingProperties($url){
        foreach ($url as $part) {
            if (empty($this->controller_name) && is_dir($this->controllers_dir . $part)) {
                $this->subdirectories[] = $part;
            } elseif (empty($this->site_subdir)) {
                $this->site_subdir = $part;
            }elseif (empty($this->controller_name)) {
                $this->controller_name = $part;
            } elseif (empty($this->action_name)) {
                $this->action_name = $part;
            } else {
                $this->parameters[] = $part;
            }
        }
    }
}
