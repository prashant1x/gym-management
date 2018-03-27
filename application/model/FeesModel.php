<?php

class FeesModel {

    public static function getFeeStructure() {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM fee_structure";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $feeStructureList = array();
                for ($i = 0, $l = sizeof($result); $i < $l; $i++) {
                    $curr = $result[$i];
                    $feeStructure = new FeeStructure();
                    $feeStructure->setDuration($curr["duration"]);
                    $feeStructure->setAmount($curr["amount"]);
                    array_push($feeStructureList, $feeStructure);
                }
                return $feeStructureList;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public static function updateFeeStructure($feeStructure) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "UPDATE fee_structure SET amount=:amount
            WHERE duration=:duration";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array( 
                    ':amount' => $feeStructure->getAmount(),
                    ':duration' => $feeStructure->getDuration()
                )
            );
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

    public static function getValidUpto($user) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM fees 
            WHERE user_id=:userId 
            ORDER BY to_date DESC
            LIMIT 1";
            $statement = $pdo->prepare($query);
            $statement->execute(
                array(
                    ':userId' => $user->getId()
                )
            );
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $fee = new Fees();
                $fee->setId($result[0]['id']);
                $fee->setUser($user);
                $fee->setFromDate($result[0]['from_date']);
                $fee->setToDate($result[0]['to_date']);
                $fee->setPaymentMode($result[0]['payment_mode']);
                $fee->setPaymentDate($result[0]['payment_date']);
                return $fee;
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public static function payFees($fee) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO fees (user_id, amount, from_date, to_date, payment_mode, payment_date) 
            VALUES (:userId, :amount, :fromDate, :toDate, :paymentMode, NOW())";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array(
                    ':userId' => $fee->getUser()->getId(), 
                    ':amount' => $fee->getAmount(),
                    ':fromDate' => $fee->getFromDate(),
                    ':toDate' => $fee->getToDate(),
                    ':paymentMode' => $fee->getPaymentMode()
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