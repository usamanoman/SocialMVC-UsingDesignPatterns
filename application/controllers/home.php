<?php

class Home extends Controller {

    public function index() {
        $homePage = new View("home/index.php");
        $homePage->make();
    }

}

