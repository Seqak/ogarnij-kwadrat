<?php

class GetAllAddress extends DBconnect{

    public function getAddresses(){

        $query = $this->connect()->query("SELECT * FROM flats_address");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}