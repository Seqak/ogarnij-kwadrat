<?php

class GetAddresses extends DBconnect{

    public function getAddress(){

        $query = $this->connect()->query("SELECT * FROM flats_address ORDER BY city ASC");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

}