<?php
define('ROOT', dirname(__DIR__) . DIRECTORY_SEPARATOR);
define('APP', ROOT . 'application' . DIRECTORY_SEPARATOR);

require(APP . 'config/config.php');
require(APP . 'core/Application.php');
require(APP . 'core/Controller.php');
require(APP . 'core/View.php');
require(APP . 'util/db/DBEngine.php');

// redirect to application
new Application();

?>