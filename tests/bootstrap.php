<?php

// Define path to application directory
defined('APPLICATION_PATH')
    || define('APPLICATION_PATH', realpath(dirname(__FILE__) . '/../application'));

// Define application environment
defined('APPLICATION_ENV')
    || define('APPLICATION_ENV', (getenv('APPLICATION_ENV') ? getenv('APPLICATION_ENV') : 'testing'));

// Ensure library/ is on include_path
set_include_path(implode(PATH_SEPARATOR, array(
    realpath(APPLICATION_PATH . '/../library'),
    get_include_path(),
    '/usr/local/zend/share/ZendFramework/library',
)));
/*
require_once 'Zend/Config.php';
$config = new Zend_Config($this->getOptions());
Zend_Registry::set('config', $config);
*/
/*
require_once 'Zend/Db.php';
$db = Zend_Db::factory('Pdo_Mysql', array(
     'host'     => 'localhost:3306',
     'username' => 'root',
     'password' => '',
     'dbname'   => 'ship2b'
));
Zend_Db_Table::setDefaultAdapter($db);
*/

require_once 'Zend/Loader/Autoloader.php';
Zend_Loader_Autoloader::getInstance();
