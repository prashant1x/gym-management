<?php

class UserModel {

    public static function isLoggedIn() {
        if (isset($_SESSION['UID'])) {
            return true;
        }
        return false;
    }

    public static function add($user) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "INSERT INTO user (email, password, address, phone, role, name)
            VALUES (:email, :password, :address, :phone, :role, :name)";
            $statement = $pdo->prepare($query);
            $res = $statement->execute(
                array( 
                    ':email' => $user->getEmail(),
                    ':password' => $user->getPassword(),
                    'address' => $user->getAddress(),
                    ':phone' => $user->getPhone(),
                    ':role' => $user->getRole(),
                    ':name' => $user->getName()
                )
            );
            if ($res) {
                $query1 = "SELECT id FROM user where email=:email";
                $stmt = $pdo->prepare($query1);
                $stmt->execute(array(':email' => $user->getEmail()));
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result1 = $stmt->fetchAll();
                $userId = $result[0]['id'];
                if ($user->getRole() == "U") {
                    $query2 = "INSERT INTO member (user_id, gender, age, weight, height)
                    VALUES (:userId, :gender, :age, :weight, :height)";
                    $stmt1 = $pdo->prepare($query2);
                    $stmt1->execute(
                        array(
                            ':userId' => $userId,
                            ':gender' => $user->getGender(),
                            ':age' => $user->getAge(),
                            ':weight' => $user->getWeight(),
                            ':height' => $user->getHeight()
                        )
                    );
                    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
                    $result2 = $stmt1->fetchAll();
                    return $result2;
                } elseif ($user->getRole() == "T") {
                    $query2 = "INSERT INTO trainer (user_id, gender, experience)
                    VALUES (:userId, :gender, :experience)";
                    $stmt1 = $pdo->prepare($query2);
                    $stmt1->execute(
                        array(
                            ':userId' => $userId,
                            ':gender' => $user->getGender(),
                            ':experience' => $user->getExperience()
                        )
                    );
                    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
                    $result2 = $stmt1->fetchAll();
                    return $result2;
                } else {
                    $query2 = "INSERT INTO manager (user_id, qualification)
                    VALUES (:userId, :qualification)";
                    $stmt1 = $pdo->prepare($query2);
                    $stmt1->execute(
                        array(
                            ':userId' => $userId,
                            ':qualification' => $user->getQualification()
                        )
                    );
                    $stmt1->setFetchMode(PDO::FETCH_ASSOC);
                    $result2 = $stmt1->fetchAll();
                    return $result2;
                }
            }
            return $res;
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return false;
    }

    public static function login($user_name, $password, $role) {
        try {
            if (isset($user_name) && strlen(trim($user_name)) > 0 
            && isset($password) && strlen(trim($password)) > 0) {
                $pdo = DBEngine::connect();
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $query = "SELECT * FROM user WHERE email=:email AND password=:password AND role=:role";
                $stmt = $pdo->prepare($query);
                $stmt->execute(array(':email' => $user_name, ":password" => $password, ":role" => $role));
                $stmt->setFetchMode(PDO::FETCH_ASSOC);
                $result = $stmt->fetchAll();
                if (sizeof($result) > 0) {
                    $curr = $result[0];
                    $role_table = ($curr['role'] == 'U' ? "member" : ($curr['role'] == 'T' ? 'trainer' : 'manager'));
                    $query = "SELECT * FROM $role_table WHERE user_id=:user_id";
                    $stmt = $pdo->prepare($query);
                    $stmt->execute(array(':user_id' => $curr['id']));
                    $stmt->setFetchMode(PDO::FETCH_ASSOC);
                    $result = $stmt->fetchAll();
                    if (sizeof($result) > 0) {
                        $curri = $result[0];
                        if ($role_table == 'member') {
                            $user = new Member();
                            $user->setAge($curri['age']);
                            $user->setGender($curri['gender']);
                            $user->setHeight($curri['height']);
                            $user->setWeight($curri['weight']);
                        } else if($role_table == 'trainer') {
                            $user = new Trainer();
                            $user->setGender($curri['gender']);
                            $user->setExperience($curri['experience']);
                            $user->setSalary($curri['salary']);
                        } else {
                            $user = new Manager();
                            $user->setQualfication($curri['qualification']);
                            $user->setSalary($curri['salary']);
                        }
                        $user->setId($curr['id']);
                        $user->setRole($role_table);
                        $user->setEmail($curr['email']);
                        $user->setName($curr['name']);
                        $user->setAddress($curr['address']);
                        $user->setPhone($curr['phone']);
                        return $user;
                    }
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public static function exists($user) {
        try {
            $pdo = DBEngine::connect();
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT * FROM user WHERE email=:email";
            $stmt = $pdo->prepare($query);
            $stmt->execute(array(':email' => $user->getEmail()));
            $stmt->setFetchMode(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return sizeof($result) > 0;
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return true;
    }

}
?>