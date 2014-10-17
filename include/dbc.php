<?php
$dbname = 'tianye_ftdat';
// Make a MySQL Connection
$link = mysql_connect("localhost", "tianye_henry", "ty8122") or die(mysql_error());
$db = mysql_select_db($dbname, $link) or die(mysql_error());

// read Chinese properly
mysql_query("SET NAMES 'UTF8'") or die(mysql_error());

// testing Zend framework
/*
$path = '/www/110mb.com/t/i/a/n/y/e/_/_/tianye/htdocs/include/'; set_include_path(get_include_path() .PATH_SEPARATOR. $path);
require_once 'Zend/Loader/Autoloader.php';
$autoloader = Zend_Loader_Autoloader::getInstance();
$autoloader->setFallbackAutoloader(true);

// load the application configuration
$config = new Zend_Config_Ini('../zend/settings.ini', 'development');
Zend_Registry::set('config', $config);

// create the application logger
$logger = new Zend_Log(new Zend_Log_Writer_Stream($config->logging->file));
Zend_Registry::set('logger', $logger);


// connect to the database
$params = array('host'     => $config->database->hostname,
                'username' => $config->database->username,
                'password' => $config->database->password,
                'dbname'   => $config->database->database);

$db = Zend_Db::factory($config->database->type, $params);
Zend_Registry::set('ftdb', $db);
*/

?>