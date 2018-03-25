<?php

/**
 * Server credentials
 */
// define('DB_NAME', 'sql12223693');
// define('DB_HOST', 'sql12.freemysqlhosting.net');
// define('DB_UNAME', 'sql12223693');
// define('DB_PWD', 'nF7xUZN2DM');

/**
 * Development credentials
 */
define('DB_NAME', 'gym-management');
define('DB_HOST', '127.0.0.1');
define('DB_UNAME', 'root');
define('DB_PWD', '');

define('URL', 'http://' . $_SERVER['HTTP_HOST'] . str_replace('public', '', dirname($_SERVER['SCRIPT_NAME'])));
?>