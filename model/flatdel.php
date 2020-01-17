<?php

require('dbconnect.php');

class FlatDelete extends DBconnect{

    public function deleteFlat($flatId, $addressId, $infoId){

        $pdo = $this->connect();

        try {
            
        $stmtFlat = $pdo->prepare("DELETE FROM flats WHERE flat_id = :flatId");
        $stmtRooms = $pdo->prepare("DELETE FROM rooms WHERE flat_id = :flatId");
        $stmtAddress = $pdo->prepare("DELETE FROM flats_address WHERE address_id = :addressId");
        $stmtInfo = $pdo->prepare("DELETE FROM flats_additional_info WHERE info_id = :infoId");

        $pdo->beginTransaction();

        $stmtRooms->bindValue(':flatId', $flatId, PDO::PARAM_STR);
        $stmtRooms->execute();

        $stmtFlat->bindValue(':flatId', $flatId, PDO::PARAM_STR);
        $stmtFlat->execute();

        $stmtAddress->bindValue(':addressId', $addressId, PDO::PARAM_STR);
        $stmtAddress->execute();

        $stmtInfo->bindValue(':infoId', $infoId, PDO::PARAM_STR);
        $stmtInfo->execute();

        $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }
}