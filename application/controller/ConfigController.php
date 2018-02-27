<?php

require_once(APP . 'model/ConfigModel.php');

class ConfigController extends Controller {

    public function __construct() {
        parent::__construct();
    }

    public function get() {
        $config = ConfigModel::get();
        if (isset($config) && sizeof($config) > 0) {
            echo $config->getSetThreshold() . "," . $config->getRepsThreshold();
            return;
        }
        echo "0,0";
        return;
    }
    
}
?>