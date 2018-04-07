<?php

class TrainerModel {

    public static function fetchAll() {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM trainer";
            $stmt = $pdo->prepare($query);
            $stmt->execute();
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            if (sizeof($result) > 0) {
                $trainerList = array();
                for ($i = 0, $l = sizeof($result); $i < $l; $i++) {
                    $trainer = new Trainer();
                    $curr = $result[$i];
                    $trainer->setGender($curr['gender']);
                    $trainer->setExperience($curr['experience']);
                    $trainer->setSalary($curr['salary']);
                    $trainer->setId($curr['user_id']);
                    $query = "SELECT * FROM user WHERE id=:trainerId";
                    $stmti = $pdo->prepare($query);
                    $stmti->execute(array(':trainerId' => $curr['user_id']));
                    $stmti->setFetchMode(PDO::FETCH_ASSOC);
                    $resulti = $stmti->fetchAll();
                    if (sizeof($resulti) > 0) {
                        $curri = $resulti[0];
                        $trainer->setEmail($curri['email']);
                        $trainer->setName($curri['name']);
                        $trainer->setAddress($curri['address']);
                        $trainer->setPhone($curri['phone']);
                    }
                    array_push($trainerList, $trainer);
                }
                return $trainerList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public static function setSalary($trainer) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE trainer SET salary=:salary WHERE user_id=:trainerId";
            $stmt = $pdo->prepare($query);
            return $stmt->execute(
                array(
                    ':salary' => $trainer->getSalary(),
                    ':trainerId' => $trainer->getId()
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

}

?>