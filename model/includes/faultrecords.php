<?php

// namespace Model\Includes\FlatRecords;

class GetFaultRecords extends DBconnect{

    public function getRecords(){

        $query = $this->connect()->query("SELECT f.fault_id, f.add_date, f.critical, t.type_name, s.status_id, s.status_name, u.user_name, u.user_surname, a.city, a.street, a.number FROM `faults` AS f INNER JOIN faults_types AS t ON f.type_id = t.type_id INNER JOIN faults_status AS s ON f.status_id = s.status_id INNER JOIN users AS u ON f.user_id = u.user_id INNER JOIN flats AS fl ON f.flat_id = fl.flat_id INNER JOIN flats_address AS a ON fl.address_id = a.address_id ");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }

    }

}

/*
SELECT f.fault_id, f.add_date, f.critical, t.type_name, s.status_name, u.user_name, u.user_surname, a.city, a.street, a.number FROM `faults` AS f INNER JOIN faults_types AS t ON f.type_id = t.type_id INNER JOIN faults_status AS s ON f.status_id = s.status_id INNER JOIN users AS u ON f.user_id = u.user_id INNER JOIN flats AS fl ON f.flat_id = fl.flat_id INNER JOIN flats_address AS a ON fl.address_id = a.address_id 


*/