<?php

class Member extends User {

    private $gender;

    private $age;

    private $weight;

    private $height;

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

    public function getAge()
    {
    	return $this->age;
    }

    public function setAge($age)
    {
    	$this->age = $age;
    }

    public function getWeight()
    {
    	return $this->weight;
    }

    public function setWeight($weight)
    {
    	$this->weight = $weight;
    }   

    public function getHeight()
    {
    	return $this->height;
    }

    public function setHeight($height)
    {
    	$this->height = $height;
    }
    
}
?>