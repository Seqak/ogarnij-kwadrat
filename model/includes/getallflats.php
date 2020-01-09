<?php

class GetAllFlats extends DBconnect{

    public function getFlats(){

        $query = $this->connect()->query("SELECT flat_id FROM flats");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getRecord(){


        $query = $this->connect()->query("SELECT * FROM flats_address INNER JOIN flats ON flats_address.address_id = flats.address_id ");

        // INNER JOIN rooms ON rooms.flat_id = flats.flat_id

        // $query = $this->connect()->query("SELECT * FROM  flats INNER JOIN flats_address ON flats_address.address_id = flats.address_id INNER JOIN rooms ON rooms.flat_id = flats.flat_id ");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }

    }
}

// rooms ON  rooms.room_id = flats.flat_id 



// PDO::FETCH_ASSOC
//PDO::FETCH_NUM

