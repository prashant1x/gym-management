<?php

class Controller {

    public $View;

    public function __construct() {
        session_start();
        $this->View = new View();
    }
}
?>