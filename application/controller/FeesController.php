<?php

require_once(APP . 'model/UserModel.php');
require_once(APP . 'model/FeesModel.php');

class FeesController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function index() {
        if (!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else {
            $feeStructureList = FeesModel::getFeeStructure();
            if (isset($feeStructureList) && sizeof($feeStructureList) > 0) {
                $GLOBALS['FeeStructureList'] = $feeStructureList;
            }
            if ($_SESSION['UROLE'] == 'member') {
                $fee = FeesModel::getValidUpto($_SESSION['USER_OBJ']);
                if (isset($fee)) {
                    $GLOBALS['LastFeesPaid'] = $fee;
                }
            }
            if ($_SESSION['UROLE'] == 'manager') {
                $userList = FeesModel::getUserList();
                if (isset($userList) && sizeof($userList) > 0) {
                    $GLOBALS['UserList'] = $userList;
                }
            }
            $this->View->render('fees_dashboard');
        }
    }

    public function updateFeeStructure() {
        if (!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else {
            if ($_SESSION['UROLE'] == 'manager'
            && isset($_POST['duration']) && strlen(trim($_POST['duration'])) > 0
            && isset($_POST['amount']) && strlen(trim($_POST['amount'])) > 0) {
                $feeStructure = new FeeStructure();
                $feeStructure->setDuration((int) $_POST['duration']);
                $feeStructure->setAmount((int) $_POST['amount']);
                if (FeesModel::updateFeeStructure($feeStructure)) {
                    $GLOBALS['success'] = 'Update successful';
                } else {
                    $GLOBALS['error'] = 'Update failed';
                }
            }
            $this->index();
        }
    }

    public function payFees() {
        if (!UserModel::isLoggedIn()) {
            $this->View->render('login');
        } else if ($_SESSION['UROLE'] == 'member') {
            require_once(APP . 'util/payment/payumoney_form.php');
        } else {
            $this->index();
        }
    }

    public function success() {
        $productinfo = explode(',', $_POST['productinfo']);
        $fromDate = date('Y-m-d', strtotime($productinfo[1]));
        $toDate = date('Y-m-d', strtotime($productinfo[2]));
        $fee = new Fees();
        $fee->setUser($_SESSION['USER_OBJ']);
        $fee->setAmount($_POST['amount']);
        $fee->setFromDate($fromDate);
        $fee->setToDate($toDate);
        $fee->setPaymentMode('Card');
        if (FeesModel::payFees($fee))
        {
            $GLOBALS['success'] = 'Payment Successful';
        } else {
            $GLOBALS['error'] = 'Unknown Error. Please contact admin.';        
        }
        $this->index();
    }

    public function failure() {
        $GLOBALS['success'] = 'Payment Failed';
        $this->index();
    }

}
?>