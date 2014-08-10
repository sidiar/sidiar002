<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Publico
 *
 * @author ariel
 */
class Application_Model_dbTable_Publico extends Zend_Db_Table_Abstract {
    
    protected $_name = "publico";
    protected $_primary = "id";
    
    protected $_dependentTables = array("Application_Model_dbTable_IniciativaPublico");
  
}
