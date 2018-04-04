<?php

class Controller {

    public $View;

    public function __construct() {
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $this->View = new View();
    }
}
?>