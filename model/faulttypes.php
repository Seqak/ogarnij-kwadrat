<?php

class Faulttypes extends DBconnect{

    public function getTypes(){

        $query = $this->connect()->query("SELECT * FROM faults_types ORDER BY type_name ASC");
        $numRows = $query->rowCount();

        if ($numRows > 0) {
            while ($row = $query->fetch(PDO::FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }
}