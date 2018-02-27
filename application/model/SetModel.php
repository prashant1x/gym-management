<?php

class SetModel {

    public static function add($set) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO user_set (rfid, start_time, end_time)
            VALUES (:rfid, :startTime, :endTime)";
            $statement = $pdo->prepare($query);
            $result = $statement->execute(
                array( 
                    ':rfid' => $set->getRFID()->getId(),
                    ':startTime' => $set->getStartTime(),
                    ':endTime' => $set->getEndTime()
                )
            );
            if ($result) {
                $query1 = "SELECT id FROM user_set
                WHERE rfid=:rfid 
                AND start_time=:startTime 
                AND end_time=:endTime";
                $stmt = $pdo->prepare($query1);
                $stmt->execute(
                    array( 
                        ':rfid' => $set->getRFID()->getId(),
                        ':startTime' => $set->getStartTime(),
                        ':endTime' => $set->getEndTime()
                    )
                );
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $res = $stmt->fetchAll();
                if (sizeof($res) > 0) {
                    return $res[0]["id"];
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return -1;
    }

    public static function get($rfid, $startTime = null, $endTime = null) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($startTime)) {
                if (isset($endTime)) {
                    $query = "SELECT * FROM user_set WHERE rfid = :rfid
                    AND start_time >= :startTime
                    AND end_time <= :endTime";
                    $statement = $pdo->prepare($query);
                    $statement->execute(
                        array(
                            ':rfid' => $rfid->getId(),
                            ':startTime' => $startTime(),
                            ':endTime' => $endTime()
                        )
                    );
                } else {
                    $query = "SELECT * FROM user_set WHERE rfid = :rfid
                    AND start_time >= :startTime";
                    $statement = $pdo->prepare($query);
                    $statement->execute(
                        array(
                            ':rfid' => $rfid->getId(),
                            ':startTime' => $startTime()
                        )
                    );
                }
            } elseif (isset($endTime)) {
                $query = "SELECT * FROM user_set WHERE rfid = :rfid
                AND end_time <= :endTime";
                $statement = $pdo->prepare($query);
                $statement->execute(
                    array(
                        ':rfid' => $rfid->getId(),
                        ':endTime' => $endTime()
                    )
                );
            } else {
                $query = "SELECT * FROM user_set WHERE rfid = :rfid";
                $statement = $pdo->prepare($query);
                $statement->execute(
                    array(
                        ':rfid' => $rfid->getId()
                    )
                );
            }
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $setList = array();
                for ($i = 0, $l = sizeof($result); $i < $l; $i++) {
                    $curr = $result[$i];
                    $set = new Set();
                    $set->setId($curr["id"]);
                    $set->setStartTime($curr["start_time"]);
                    $set->setEndTime($curr["end_time"]);
                    $set->setRFID($rfid);
                    array_push($setList, $set);
                }
                return $setList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

}
?>