<?php


class NewFaultTransaction extends DBconnect{

    public function addFault($data){

        $pdo = $this->connect();

        try {

            $flatIdQuery = $pdo->query("SELECT flat_id FROM flats WHERE address_id = '$data[1]'");

            $flatId = $flatIdQuery->fetch();
            $stmtInfo = $pdo->prepare("INSERT INTO faults_additional_info VALUES (NULL, :content)");
            $stmtFault = $pdo->prepare("INSERT INTO faults VALUES (NULL, :typeId, :statusId, :infoId, :userId, :flatId, :addDate, :critical)");


            $pdo->beginTransaction();

            $stmtInfo->bindValue(':content', $data[2], PDO::PARAM_STR);
            $stmtInfo->execute();
            $infoId = $pdo->lastInsertId();

            $stmtFault->bindValue(':typeId', $data[0], PDO::PARAM_INT);
            $stmtFault->bindValue(':statusId', 1, PDO::PARAM_INT);
            $stmtFault->bindValue(':infoId', $infoId, PDO::PARAM_INT);
            $stmtFault->bindValue(':userId', $data[3], PDO::PARAM_INT);
            $stmtFault->bindValue(':flatId', $flatId['flat_id'], PDO::PARAM_INT);
            $stmtFault->bindValue(':addDate', $data[4], PDO::PARAM_STR);
            $stmtFault->bindValue(':critical', $data[5], PDO::PARAM_BOOL);
            $stmtFault->execute();

            $pdo->commit();
            

        } catch (\Exception $e) {
            if ($pdo->inTransaction()) {
                $pdo->rollback();
            }
            throw $e;
        }
    }

}