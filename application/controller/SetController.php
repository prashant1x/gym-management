<?php

require_once(APP . 'model/SetModel.php');
require_once(APP . 'model/RepsModel.php');
require_once(APP . 'model/RFIDModel.php');

class SetController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function add() {
        if (isset($_POST["data"]) && strlen($_POST["data"]) > 0) {
            $res = json_decode($_POST["data"]);
            $rfid = new RFID();
            $rfid->setId($res->rfid);
            if (sizeof($res->set) > 0) {
                $set = new Set();
                $set->setRFID($rfid);
                $set->setStartTime($res->set[0]->startTime);
                $set->setEndTime($res->set[(sizeof($res->set) - 1)]->endTime);
                $set->setId(SetModel::add($set));
            }
            for ($i = 0, $l = sizeof($res->set); $i < $l; $i++) {
                $reps = new Reps();
                $reps->setSet($set);
                $reps->setStartTime($res->set[$i]->startTime);
                $reps->setEndTime($res->set[$i]->endTime);
                $reps->setCount($res->set[$i]->reps);
                RepsModel::add($reps);
            }
            return;
        }
    }

    public function getSets() {
        $rfid = RFIDModel::getRFID($_SESSION["USER_OBJ"]);
        if (isset($rfid)) {
            $setList = SetModel::get($rfid);
            if (isset($setList) && sizeof($setList) > 0) {
                $GLOBALS['SetList'] = $setList;
            }
        }
        $this->View->render('set_dashboard');
    }

    public function getReps($setId = null) {
        $rfid = RFIDModel::getRFID($_SESSION["USER_OBJ"]);
        if (isset($rfid)) {
            if (isset($setId)) {
                $set = new Set();
                $set->setId($setId);
                $repsList = RepsModel::get(null, $set);
            } else {
                $repsList = RepsModel::get($rfid);
            }
            if (isset($repsList) && sizeof($repsList) > 0) {
                $GLOBALS['RepsList'] = $repsList;
            }
        }
        $this->View->render('reps_dashboard');
    }
    
}
?>