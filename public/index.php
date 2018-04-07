<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require(APP . 'config/config.php');
require(APP . 'core/Application.php');
require(APP . 'core/Controller.php');
require(APP . 'core/View.php');
require(APP . 'util/db/DBEngine.php');

require(APP . 'model/popo/User.php');
require(APP . 'model/popo/Member.php');
require(APP . 'model/popo/Trainer.php');
require(APP . 'model/popo/Manager.php');
require(APP . 'model/popo/Set.php');
require(APP . 'model/popo/Reps.php');
require(APP . 'model/popo/RFID.php');
require(APP . 'model/popo/Config.php');
require(APP . 'model/popo/Fees.php');
require(APP . 'model/popo/FeeStructure.php');

// redirect to application
new Application();

?>