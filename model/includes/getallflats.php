<?php

class GetAllFlats extends DBconnect{

    public function getFlats(){

        $query = $this->connect()->query("SELECT * FROM flats");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch()) {
                $data[] = $row;
            }
            return $data;
        }
    }

}