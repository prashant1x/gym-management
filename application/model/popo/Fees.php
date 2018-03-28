<?php

class Fees {

    private $id;

    private $user;

    private $amount;

    private $fromDate;

    private $toDate;

    private $paymentMode;

    private $paymentDate;

    public function getId()
    {
    	return $this->id;
    }

    public function setId($id)
    {
    	$this->id = $id;
    }

    public function getUser()
    {
    	return $this->user;
    }

    public function setUser($user)
    {
    	$this->user = $user;
    }

    public function getAmount()
    {
    	return $this->amount;
    }

    public function setAmount($amount)
    {
    	$this->amount = $amount;
    }

    public function getFromDate()
    {
    	return $this->fromDate;
    }

    public function setFromDate($fromDate)
    {
    	$this->fromDate = $fromDate;
    }

    public function getTodate()
    {
    	return $this->toDate;
    }

    public function setTodate($toDate)
    {
    	$this->toDate = $toDate;
    }

    public function getPaymentMode()
    {
    	return $this->paymentMode;
    }

    public function setPaymentMode($paymentMode)
    {
    	$this->paymentMode = $paymentMode;
    }

    public function getPaymentDate()
    {
    	return $this->paymentDate;
    }

    public function setPaymentDate($paymentDate)
    {
    	$this->paymentDate = $paymentDate;
    }

}
?>