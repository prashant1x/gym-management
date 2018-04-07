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

    public function login() {
        if (!UserModel::isLoggedIn()) {
            if (isset($_POST['email']) && strlen(trim($_POST['email'])) > 0
            && isset($_POST['password']) && strlen(trim($_POST['password'])) > 0
            && isset($_POST['role']) && strlen(trim($_POST['role'])) > 0) {
                $user = UserModel::login(trim($_POST['email']), trim($_POST['password']), trim($_POST['role']));
                if (isset($user)) {
                    $_SESSION['UID'] = $user->getId();
                    $_SESSION['UROLE'] = $user->getRole();
                    $_SESSION['UNAME'] = $user->getName();
                    $_SESSION['USER_OBJ'] = $user;
                    $this->View->render('home');
                } else {
                    $GLOBALS['error'] = 'Invalid email or password';
                    $this->View->render('login');
                }
            } else {
                $GLOBALS['error'] = 'All fields mandatory';
                $this->View->render('login');
            }
        } else {
            $this->View->render('home');
        }
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