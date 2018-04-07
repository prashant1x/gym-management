<?php

class Trainer extends User {

    private $gender;

    private $experience;

    private $salary;

    public function __construct() {
        parent::__construct();
    }

    public function getGender()
    {
    	return $this->gender;
    }

    public function setGender($gender)
    {
    	$this->gender = $gender;
    }

    public function getExperience()
    {
    	return $this->experience;
    }

    public function setExperience($experience)
    {
    	$this->experience = $experience;
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