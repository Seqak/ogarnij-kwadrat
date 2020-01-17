<?php

class flatListRecord{

    public $flatId;
    public $addressId;
    public $infoId;
    public $city;
    public $street;
    public $number;
    public $rooms;


    public function setFlatId($arg){
        $this->flatId = $arg;
    }
    public function setAddressId($arg){
        $this->addressId = $arg;
    }
    public function setInfoId($arg){
        $this->infoId = $arg;
    }
    public function setCity($arg){
        $this->city = $arg;
    }
    public function setStreet($arg){
        $this->street = $arg;
    }
    public function setNumber($arg){
        $this->number = $arg;
    }
    public function setRooms($arg){
        $this->rooms = $arg;
    }

}