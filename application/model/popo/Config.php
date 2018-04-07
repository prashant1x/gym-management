<?php

class Config {

    private $setThreshold;

    private $repsThreshold;

    public function getSetThreshold()
    {
        return $this->setThreshold;
    }

    public function setSetThreshold($setThreshold)
    {
        $this->setThreshold = $setThreshold;
    }

    public function getRepsThreshold()
    {
        return $this->repsThreshold;
    }

    public function setRepsThreshold($repsThreshold)
    {
        $this->repsThreshold = $repsThreshold;
    }

}
?>