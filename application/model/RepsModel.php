<?php

class RepsModel {

    public static function add($reps) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO user_reps (set_id, start_time, end_time, count)
            VALUES (:setId, :startTime, :endTime, :count)";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array( 
                    ':setId' => $reps->getSet()->getId(),
                    ':startTime' => $reps->getStartTime(),
                    ':endTime' => $reps->getEndTime(),
                    ':count' => $reps->getCount()
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

    public static function get($rfid, $set = null, $startTime = null, $endTime = null) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            if (isset($set)) {
                $query = "SELECT * FROM user_reps WHERE set_id = :setId";
                $statement = $pdo->prepare($query);
                $statement->execute(
                    array(
                        ':setId' => $set->getId()
                    )
                );
            } elseif (isset($startTime)) {
                if (isset($endTime)) {
                    $query = "SELECT * FROM user_reps WHERE set_id IN (SELECT id FROM user_set WHERE rfid = :rfid)
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
                    $query = "SELECT * FROM user_reps WHERE set_id IN (SELECT id FROM user_set WHERE rfid = :rfid)
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
                $query = "SELECT * FROM user_reps WHERE set_id IN (SELECT id FROM user_set WHERE rfid = :rfid)
                AND end_time <= :endTime";
                $statement = $pdo->prepare($query);
                $statement->execute(
                    array(
                        ':rfid' => $rfid->getId(),
                        ':endTime' => $endTime()
                    )
                );
            } else {
                $query = "SELECT * FROM user_reps WHERE set_id IN (SELECT id FROM user_set WHERE rfid = :rfid)";
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
                $repsList = array();
                for ($i = 0, $l = sizeof($result); $i < $l; $i++) {
                    $curr = $result[$i];
                    $reps = new Reps();
                    $reps->setId($curr["id"]);
                    $reps->setStartTime($curr["start_time"]);
                    $reps->setEndTime($curr["end_time"]);
                    $reps->setCount($curr["count"]);
                    $set = new Set();
                    $set->setId($curr["set_id"]);
                    $reps->setSet($set);
                    array_push($repsList, $reps);
                }
                return $repsList;
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