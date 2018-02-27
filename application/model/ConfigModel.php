<?php

class ConfigModel {

    public static function add($config) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO app_config (set_threshold, reps_threshold)
            VALUES (:setThreshold, :repsThreshold)";
            $statement = $pdo->prepare($query);
            return $statement->execute(
                array( 
                    ':setId' => $config->getSetThreshold(),
                    ':repsThreshold' => $config->getRepsThreshold()
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
            $query = "SELECT * FROM app_config";
            $statement = $pdo->prepare($query);
            $statement->execute();
            $statement->setFetchMode(PDO::FETCH_ASSOC);
            $result = $statement->fetchAll();
            if (sizeof($result) > 0) {
                $config = new Config();
                $config->setSetThreshold($result[0]["set_threshold"]);
                $config->setRepsThreshold($result[0]["reps_threshold"]);
                return $config;
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