<?php
// require('../../model/dbconnect.php');

class FlatRecord  extends DBconnect{
    private $flatId;
    private $city;
    private $street;
    private $number;
    private $roomsAmount;
    private $roomStatus;


    public function __construct($i){


        $this->flatId = $i;

        // $flatId, $address, $room

        // $this->flatId = $flatId;
        // $this->city = $address[0];
        // $this->street = $address[1];
        // $this->numer = $address[2];
        // $this->roomsAmount = $room[0];
        // $this->roomStatus = $room[1];
    }


    public function setId(){
        return $this->flatId;
    }

    public function getId(){
        return $this->flatId;
    }
}