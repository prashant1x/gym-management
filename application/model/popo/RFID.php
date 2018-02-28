<?php

class RFID {

    private $id;

    private $cardId;

    private $user;

    public function getId()
    {
        return $this->id;
    }

    public function setId($id)
    {
            $this->id = $id;
    }

    public function getCardId()
    {
            return $this->cardId;
    }

    public function setCardId($cardId)
    {
            $this->cardId = $cardId;
    }

    public function getUser()
    {
            return $this->user;
    }

    public function setUser($user)
    {
            $this->user = $user;
    }

}
?>