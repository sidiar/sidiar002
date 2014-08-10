<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Sector
 *
 * @author ariel
 */

class Application_Model_dbTable_Sector extends Zend_Db_Table_Abstract
{
 protected $_name = 'sector';
 protected $_primary = 'id';
 
 protected $_dependentTables = array('Application_Model_dbTable_IniciativaSector');
 
}
