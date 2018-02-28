<?php

class RFIDModel {

    public static function add($rfid) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO rfid (id, card_id)
            VALUES (:id, :cardId)";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array( 
                    ':id' => $rfid->getId(),
                    ':cardId' => $rfid->getCardId()
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

    public static function get() {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM rfid WHERE user_id IS NULL";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $rfidList = array();
                for ($i = 0, $l = sizeof($result); $i < $l; $i++) {
                    $curr = $result[$i];
                    $rfid = new RFID();
                    $rfid->setId($curr["id"]);
                    $rfid->setCardId($curr["card_id"]);
                    array_push($rfidList, $rfid);
                }
                return $rfidList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public static function assign($user, $rfid) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE rfid SET user_id=:userId WHERE id=:id";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array(
                    ":userId" => $user->getId(),
                    ":id" => $rfid->getId()
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

    public static function getRFID($user) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM rfid WHERE user_id=:userId";
            $statement = $pdo->prepare($query);
            $statement->execute(
                array(
                    ":userId" => $user->getId()
                )
            );
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $rfid = new RFID();
                $rfid->setId($result[0]["id"]);
                return $rfid;
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