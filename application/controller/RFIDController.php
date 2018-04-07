<?php

require_once(APP . 'model/SetModel.php');
require_once(APP . 'model/RepsModel.php');
require_once(APP . 'model/RFIDModel.php');
require_once(APP . 'model/UserModel.php');

class RFIDController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else {
            if ($_SESSION['UROLE'] == "manager") {
                $rfidList = RFIDModel::get();
                if (isset($rfidList) && sizeof($rfidList) > 0) {
                    $GLOBALS["RFIDList"] = $rfidList;
                }
                $userList = UserModel::getUnAssignedUsers();
                if (isset($userList) && sizeof($userList) > 0) {
                    $GLOBALS["UserList"] = $userList;
                }
                $this->View->render('rfid_linking');
            } else {
                $this->View->render('home');
            }
        }
    }

    public function add() {
        if (isset($_POST["id"]) && strlen($_POST["id"]) > 0
        && isset($_POST["card_id"]) && strlen($_POST["card_id"]) > 0) {
            $rfid = new RFID();
            $rfid->setId($_POST["id"]);
            $rfid->setCardId($_POST["card_id"]);
            echo RFIDModel::add($rfid);
            return;
        }
    }

    public function assign() {
        if (isset($_POST["id"]) && strlen($_POST["id"]) > 0
        && isset($_POST["user_id"]) && strlen($_POST["user_id"]) > 0) {
            $user = new User();
            $user->setId($_POST["user_id"]);
            $rfid = new RFID();
            $rfid->setId($_POST["id"]);
            RFIDModel::assign($user, $rfid);
        }
        $this->index();
    }
    
}
?>