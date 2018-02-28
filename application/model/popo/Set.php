<?php

class Set {

	private $rfid;

	private $id;

	private $startTime;

	private $endTime;

	public function getRFID()
	{
		return $this->rfid;
	}

	public function setRFID($rfid)
	{
		$this->rfid = $rfid;
	}

	public function getId()
	{
		return $this->id;
	}

	public function setId($id)
	{
		$this->id = $id;
	}

	public function getStartTime()
	{
		return $this->startTime;
	}

	public function setStartTime($startTime)
	{
		$this->startTime = $startTime;
	}

	public function getEndTime()
	{
		return $this->endTime;
	}

	public function setEndTime($endTime)
	{
		$this->endTime = $endTime;
	}

}

?>