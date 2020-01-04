<?php
require('dbconnect.php');

class FlatTransaction extends DBconnect{

    //Add flat with Rooms and Additional info.
    public function flatTransOne($data){

        $pdo = $this->connect();

        try {
            
            $stmtAddress = $pdo->prepare("INSERT INTO flats_address VALUES (NULL, :city, :street, :number)");

            $stmtInfo = $pdo->prepare("INSERT INTO flats_additional_info VALUES (NULL, :content)");

            $stmtFlat = $pdo->prepare("INSERT INTO flats VALUES (NULL, :addresId, :infoId)");

            $stmtRooms = $pdo->prepare("INSERT INTO rooms VALUES (NULL, :number, :flatId)");

            $pdo->beginTransaction();

            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->execute();

            $addresId = $pdo->lastInsertId(); 

            $stmtInfo->bindValue(':content', $data[5], PDO::PARAM_STR);
            $stmtInfo->execute();

            $infoId = $pdo->lastInsertId();

            $stmtFlat->bindValue(':addresId', $addresId, PDO::PARAM_INT);
            $stmtFlat->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtFlat->execute();

            $flatId = $pdo->lastInsertId();


            for ($i=1; $i <= $data[4] ; $i++) { 
                $stmtRooms->bindValue(':number', $i, PDO::PARAM_INT);
                $stmtRooms->bindValue(':flatId', $flatId, PDO::PARAM_INT);
                $stmtRooms->execute();
            }

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

    //Add flat with Rooms.
    public function flatTransTwo($data){
        $pdo = $this->connect();


        try {
            $stmtAddress = $pdo->prepare("INSERT INTO flats_address VALUES (NULL, :city, :street, :number)");

            $stmtFlat = $pdo->prepare("INSERT INTO flats VALUES (NULL, :addresId, NULL)");

            $stmtRooms = $pdo->prepare("INSERT INTO rooms VALUES (NULL, :number, :flatId)");

            $pdo->beginTransaction();

            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->execute();

            $addresId = $pdo->lastInsertId(); 

            $stmtFlat->bindValue(':addresId', $addresId, PDO::PARAM_INT);
            $stmtFlat->execute();

            $flatId = $pdo->lastInsertId();


            for ($i=1; $i <= $data[4] ; $i++) { 
                $stmtRooms->bindValue(':number', $i, PDO::PARAM_INT);
                $stmtRooms->bindValue(':flatId', $flatId, PDO::PARAM_INT);
                $stmtRooms->execute();
            }

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

    //Add flat with Additional info.
    public function flatTransThree($data){
        $pdo = $this->connect();

        try {
            $stmtAddress = $pdo->prepare("INSERT INTO flats_address VALUES (NULL, :city, :street, :number)");

            $stmtInfo = $pdo->prepare("INSERT INTO flats_additional_info VALUES (NULL, :content)");

            $stmtFlat = $pdo->prepare("INSERT INTO flats VALUES (NULL, :addresId, :infoId)");

            $pdo->beginTransaction();

            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->execute();

            $addresId = $pdo->lastInsertId(); 

            $stmtInfo->bindValue(':content', $data[3], PDO::PARAM_STR);
            $stmtInfo->execute();

            $infoId = $pdo->lastInsertId();

            $stmtFlat->bindValue(':addresId', $addresId, PDO::PARAM_INT);
            $stmtFlat->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtFlat->execute();

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

    //Add flat only with address 
    public function flatTransFour($data){

        $pdo = $this->connect();

        try {
            $stmtAddress = $pdo->prepare("INSERT INTO flats_address VALUES (NULL, :city, :street, :number)");

            $stmtFlat = $pdo->prepare("INSERT INTO flats VALUES (NULL, :addresId, NULL)");

            $pdo->beginTransaction();

            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->execute();

            $addresId = $pdo->lastInsertId(); 

            $stmtFlat->bindValue(':addresId', $addresId, PDO::PARAM_INT);
            $stmtFlat->execute();

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }
}
