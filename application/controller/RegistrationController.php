<?php

require_once(APP . 'model/UserModel.php');

class RegistrationController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if(!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else {
            $this->View->render('home');
        }
    }

    /**
     * method for registration based on roles
     */
    public function register() {
        if (!UserModel::isLoggedIn()) {
            if (isset($_POST['email']) && strlen(trim($_POST['email'])) > 0
            && isset($_POST['password']) && strlen(trim($_POST['password'])) > 0
            && isset($_POST['address']) && strlen(trim($_POST['address'])) > 0
            && isset($_POST['phone']) && strlen(trim($_POST['phone'])) > 0
            && isset($_POST['role']) && strlen(trim($_POST['role'])) > 0
            && isset($_POST['name']) && strlen(trim($_POST['name'])) > 0)
            {
                if ($_POST['role'] == "U"
                && isset($_POST['genderU']) && strlen(trim($_POST['genderU'])) > 0
                && isset($_POST['age']) && strlen(trim($_POST['age'])) > 0
                && isset($_POST['weight']) && strlen(trim($_POST['weight'])) > 0
                && isset($_POST['height']) && strlen(trim($_POST['height'])) > 0) {
                    $user = new Member();
                    $user->setGender(trim($_POST['genderU']));
                    $user->setAge(trim($_POST['age']));
                    $user->setWeight(trim($_POST['weight']));
                    $user->setHeight(trim($_POST['height']));
                    $user->setRole("U");
                } else if ($_POST['role'] == "T"
                && isset($_POST['genderT']) && strlen(trim($_POST['genderT'])) > 0
                && isset($_POST['experience']) && strlen(trim($_POST['experience'])) > 0) {
                    $user = new Trainer();
                    $user->setGender(trim($_POST['genderT']));
                    $user->setExperience(trim($_POST['experience']));
                    $user->setRole("T");
                } else if ($_POST['role'] == "M"
                && isset($_POST['qualification']) && strlen(trim($_POST['qualification'])) > 0) {
                    $user = new Manager();
                    $user->setQualification(trim($_POST['qualification']));
                    $user->setRole("M");
                } else {
                    $GLOBALS['error'] = 'All parameters required';
                    $this->index();
                    return;
                }

                if (isset($user)) {
                    $user->setName(trim($_POST['name']));
                    $user->setEmail(trim($_POST['email']));
                    $user->setPassword(trim($_POST['password']));
                    $user->setAddress(trim($_POST['address']));
                    $user->setPhone(trim($_POST['phone']));
                    $user->setRole(trim($_POST['role']));
                    
                    if (UserModel::exists($user)) {
                        $GLOBALS['error'] = 'User already exists';
                        $this->index();
                        return;
                    }
                    if (UserModel::add($user)) {
                        $GLOBALS['success'] = 'Registration Successful';
                        $this->index();
                        return;
                    } else {
                        $GLOBALS['error'] = 'Registration not done. Please try again';
                        $this->index();
                        return;
                    }
                } else {
                    $GLOBALS['error'] = 'Invalid Request';
                    $this->index();
                    return;
                }

            } else {
                $GLOBALS['error'] = 'All parameters required';
                $this->index();
                return;
            }
        } else {
            $this->View->render('home');
        }
    }

}

?>