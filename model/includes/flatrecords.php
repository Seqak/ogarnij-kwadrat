<?php

// namespace Model\Includes\FlatRecords;

class GetFlatRecords extends DBconnect{

    public function getRecords(){

        $query = $this->connect()->query("SELECT f.flat_id, f.address_id, f.info_id, a.city, a.street, a.number, COUNT(r.flat_id) FROM `flats` AS f INNER JOIN flats_address AS a ON f.address_id = a.address_id LEFT JOIN rooms AS r ON f.flat_id = r.flat_id GROUP BY f.flat_id ORDER BY a.city ASC");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }

    }

    public function getOneRecord($flatId){

        $query = $this->connect()->query("SELECT f.flat_id, f.address_id, f.info_id, a.city, a.street, a.number, COUNT(r.flat_id), i.content FROM `flats` AS f INNER JOIN flats_address AS a ON f.address_id = a.address_id LEFT JOIN flats_additional_info AS i ON f.info_id = i.info_id LEFT JOIN rooms AS r ON f.flat_id = r.flat_id WHERE f.flat_id = '$flatId' GROUP BY f.flat_id");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            $data = $query->fetch(PDO::FETCH_ASSOC);
            
            return $data;
        }

    }

    public function getRoomsAmount($flatId){

        $query = $this->connect()->query("SELECT room_id FROM rooms WHERE flat_id = '$flatId'");
        $numRows = $query->rowCount();
        
        while ($row = $query->fetch(PDO::FETCH_NUM)) {
            $data[] = $row;
        }

        for ($i=0; $i <= count($data)-1 ; $i++) {            
            $roomsIds[] = $data[$i][0];
        }

        return $roomsIds;
    }
}


