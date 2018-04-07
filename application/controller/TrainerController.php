<?php

require_once(APP . 'model/TrainerModel.php');
require_once(APP . 'model/UserModel.php');
require_once(APP . 'model/RFIDModel.php');
require_once(APP . 'model/RepsModel.php');

class TrainerController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if(!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else if ($_SESSION['UROLE'] == 'manager') {
            $trainerList = TrainerModel::fetchAll();
            if (isset($trainerList) && sizeof($trainerList) > 0) {
                $GLOBALS['TrainerList'] = $trainerList;
            }
            $this->View->render('trainer_management');
        } else {
            $this->View->render('home');
        }
    }

    public function setSalary() {
        if(!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else if ($_SESSION['UROLE'] == 'manager') {
            if (isset($_POST['trainerId']) && strlen(trim($_POST['trainerId'])) > 0
            && isset($_POST['salary']) && strlen(trim($_POST['salary'])) > 0) {
                $trainer = new Trainer();
                $trainer->setId(trim($_POST['trainerId']));
                $trainer->setSalary(trim($_POST['salary']));
                if (TrainerModel::setSalary($trainer)) {
                    $GLOBALS['success'] = "Salary modified successfully";
                } else {
                    $GLOBALS['error'] = "Salary not modified";
                }
            } else {
                $GLOBALS['error'] = "Required parameters not passed";
            }
            $this->index();
        } else {
            $this->View->render('home');
        }
    }

    public function getUserGraph() {
        if(!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else if ($_SESSION['UROLE'] == 'trainer') {
            $userList = UserModel::getAllUsers();
            if (isset($userList) && sizeof($userList) > 0) {
                $GLOBALS['UserList'] = $userList;
            }
            if (isset($_POST['userId']) && $_POST['userId']) {
                $user = new User();
                $user->setId($_POST['userId']);
                $rfid = RFIDModel::getRFID($user);
                $repsList = RepsModel::get($rfid);
                $repsData = RepsModel::getGraph($rfid);
                if (isset($repsList) && sizeof($repsList) > 0) {
                    $GLOBALS['RepsList'] = $repsList;
                }
                if (isset($repsData) && sizeof($repsData) > 0) {
                    $GLOBALS['RepsData'] = $repsData;
                }
            }
            $this->View->render('user_graph');
        } else {
            $this->View->render('home');
        }
    }

}

?>