<?php

// namespace Model\Includes\FlatRecords;

class GetFlatRecords extends DBconnect{

    public function getRecords(){

        $query = $this->connect()->query("SELECT f.flat_id, a.city, a.street, a.number, COUNT(r.flat_id) FROM `flats` AS f INNER JOIN flats_address AS a ON f.address_id = a.address_id LEFT JOIN rooms AS r ON f.flat_id = r.flat_id GROUP BY f.flat_id ");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }

    }
}


