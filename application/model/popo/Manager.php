<?php

class Manager extends User {

    private $qualification;

    private $salary;

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