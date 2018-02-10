<?php

require_once(APP . 'model/UserModel.php');

class LoginController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else {
            $this->View->render('home');
        }
    }

    public function login($user_name, $password, $role) {
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
                    $this->index();
                }
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        } finally {
            DBEngine::disconnect();
        }
        return null;
    }

    public function logout() {
        if (UserModel::isLoggedIn()) {
            $_SESSION['UID'] = null;
            $_SESSION['UROLE'] = null;
            $_SESSION['UNAME'] = null;
            $_SESSION['USER_OBJ'] = null;
            session_destroy();
            $this->View->render('login');
        } else {
            $this->View->render('login');
        }
    }
    
}
?>