<?php

class Manager extends User {

    private $qualification;

    private $salary;

    public function __construct() {
        parent::__construct();
    }

    public function getQualification()
    {
    	return $this->qualification;
    }

    public function setQualification($qualification)
    {
    	$this->qualification = $qualification;
    }

    public function getSalary()
    {
    	return $this->salary;
    }

    public function setSalary($salary)
    {
    	$this->salary = $salary;
    }
}
?>