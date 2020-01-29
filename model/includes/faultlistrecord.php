<?php

class FaultListRecord{

    public $city;
    public $street;
    public $number;

    public $faultId;
    public $statusName;
    public $typeName;
    public $data;
    public $critical;
    public $userName;
    public $userSurname;
    public $statusId;

    public function setCity($arg){
        $this->city = $arg;
    }
    public function setStreet($arg){
        $this->street = $arg;
    }
    public function setNumber($arg){
        $this->number = $arg;
    }
    public function setFaultId($arg){
        $this->faultId = $arg;
    }
    public function setStatusName($arg){
        $this->statusName = $arg;
    }
    public function setTypeName($arg){
        $this->typeName = $arg;
    }
    public function setData($arg){
        $this->data = $arg;
    }
    public function setCritical($arg){
        $this->critical = $arg;
    }
    public function setUserName($arg){
        $this->userName = $arg;
    }
    public function setUserSurname($arg){
        $this->userSurname = $arg;
    }
    public function setStatusId($arg){
        $this->statusId = $arg;
    }


}