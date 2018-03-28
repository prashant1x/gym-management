<?php

class FeeStructure {

    private $duration;

    private $amount;

    public function getDuration()
    {
    	return $this->duration;
    }

    public function setDuration($duration)
    {
    	$this->duration = $duration;
    }

    public function getAmount()
    {
    	return $this->amount;
    }

    public function setAmount($amount)
    {
    	$this->amount = $amount;
    }
    
}
?>