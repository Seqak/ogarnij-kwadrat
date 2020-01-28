<?php

class FlatsAddress extends DBconnect{
    public $addressId;
    public $city;
    public $street;
    public $number;

    public function setAddressId($arg){
        $this->addressId = $arg;
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
}