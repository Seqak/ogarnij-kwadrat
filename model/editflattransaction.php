<?php

class EditFlatTransaction extends DBconnect{


    public function editFlatTransTwo($data, $roomsIds, $infoId, $flatId, $addressId, $roomsAmount, $oldRoomsAmount){

        $pdo = $this->connect();

        try {
    
            // Zmieniam id informacji w flats na null
            $stmtFlatInfo = $pdo->prepare("UPDATE flats SET info_id = NULL WHERE flat_id = :flatId");
            // usuwam info z info
            $stmtInfoDelete = $pdo->prepare("DELETE FROM flats_additional_info WHERE info_id = :infoId ");
            //Dodaję / usuwam pokoje
            $stmtRoomsAdd = $pdo->prepare("INSERT INTO rooms VALUES (NULL, :number, :flatId)");
            $stmtRoomsDel = $pdo->prepare("DELETE FROM rooms WHERE number = :number");
            // Update adresu
            $stmtAddress = $pdo->prepare("UPDATE flats_address SET city = :city, street = :street, number = :number WHERE address_id = :addressId");
            
            
            $pdo->beginTransaction();

            // Zmieniam id informacji w flats na null
            $stmtFlatInfo->bindValue(':flatId', $flatId, PDO::PARAM_INT);
            $stmtFlatInfo->execute();

            // usuwam info z info
            $stmtInfoDelete->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtInfoDelete->execute();

            if ($roomsAmount[1] == true) {
                
                for ($i = 1; $i <= $roomsAmount[0]; $i++) { 

                    $num = $oldRoomsAmount + $i;
                    $stmtRoomsAdd->bindValue(':number', $num, PDO::PARAM_INT);
                    $stmtRoomsAdd->bindValue(':flatId', $flatId, PDO::PARAM_INT);
                    $stmtRoomsAdd->execute();
                }  
            }
            elseif ($roomsAmount[1] == false) {
                
                for ($i = 1; $i <= $roomsAmount[0]; $i++) { 
                    
                    $num = $oldRoomsAmount;
                    $stmtRoomsDel->bindValue(':number', $num, PDO::PARAM_INT);
                    $stmtRoomsDel->execute();
                    $oldRoomsAmount = ($oldRoomsAmount - 1);
                }
            }
            
            // update adresu
            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->bindValue(':addressId', $addressId, PDO::PARAM_INT);
            $stmtAddress->execute();

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }


    public function editFlatTransThree($data, $roomsIds, $infoId, $flatId, $addressId){

        $pdo = $this->connect();

        try {
            // Usuwam pokoje
            $stmtRooms = $pdo->prepare("DELETE FROM rooms WHERE room_id = :roomId ");
            // Zmieniam id informacji w flats na null
            $stmtFlatInfo = $pdo->prepare("UPDATE flats SET info_id = NULL WHERE flat_id = :flatId");
            // usuwam info z info
            $stmtInfoDelete = $pdo->prepare("DELETE FROM flats_additional_info WHERE info_id = :infoId ");
            // dodaje info
            $stmtInfoAdd = $pdo->prepare("INSERT INTO flats_additional_info (`info_id`, `content`) VALUES (NULL, :content) ");
            // dodaje id info do flats
            $stmtFlatInfoAdd = $pdo->prepare("UPDATE flats SET info_id = :infoId WHERE flat_id = :flatId");
            // update adresu
            $stmtAddress = $pdo->prepare("UPDATE flats_address SET city = :city, street = :street, number = :number WHERE address_id = :addressId");
            
            $pdo->beginTransaction();

            // Usuwam pokoje
            for ($i = 0; $i <= count($roomsIds) - 1 ; $i++) { 

                $stmtRooms->bindValue(':roomId', $roomsIds[$i], PDO::PARAM_INT);
                $stmtRooms->execute();
            }

            // Zmieniam id informacji w flats na null
            $stmtFlatInfo->bindValue(':flatId', $flatId, PDO::PARAM_INT);
            $stmtFlatInfo->execute();

            // usuwam info z info
            $stmtInfoDelete->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtInfoDelete->execute();
            
            // dodaje info
            $stmtInfoAdd->bindValue(':content', $data[3], PDO::PARAM_STR);
            $stmtInfoAdd->execute();

            // pobieram id
            $infoRecordId = $pdo->lastInsertId();

            // dodaje id info do flats
            $stmtFlatInfoAdd->bindValue(':infoId', $infoRecordId, PDO::PARAM_INT);
            $stmtFlatInfoAdd->bindValue(':flatId', $flatId, PDO::PARAM_INT);
            $stmtFlatInfoAdd->execute();
            
            // update adresu
            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->bindValue(':addressId', $addressId, PDO::PARAM_INT);
            $stmtAddress->execute();
            

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

    public function editFlatTransFour($data, $roomsIds, $infoId, $flatId, $addressId){

        $pdo = $this->connect();

        try {
            
            $stmtRooms = $pdo->prepare("DELETE FROM rooms WHERE room_id = :roomId ");

            $stmtFlatInfo = $pdo->prepare("UPDATE flats SET info_id = NULL WHERE flat_id = :flatId");

            $stmtInfo = $pdo->prepare("DELETE FROM flats_additional_info WHERE info_id = :infoId ");

            $stmtAddress = $pdo->prepare("UPDATE flats_address SET city = :city, street = :street, number = :number WHERE address_id = :addressId");
            
            $pdo->beginTransaction();

            for ($i = 0; $i <= count($roomsIds) - 1 ; $i++) { 

                $stmtRooms->bindValue(':roomId', $roomsIds[$i], PDO::PARAM_INT);
                $stmtRooms->execute();
            }

            $stmtFlatInfo->bindValue(':flatId', $flatId, PDO::PARAM_INT);
            $stmtFlatInfo->execute();

            $stmtInfo->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtInfo->execute();
            
            $stmtAddress->bindValue(':city', $data[0], PDO::PARAM_STR);
            $stmtAddress->bindValue(':street', $data[1], PDO::PARAM_STR);
            $stmtAddress->bindValue(':number', $data[2], PDO::PARAM_STR);
            $stmtAddress->bindValue(':addressId', $addressId, PDO::PARAM_INT);
            $stmtAddress->execute();

            $pdo->commit();
            
        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

} 


?>