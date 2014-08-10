<?php
require_once 'IniciativaRow.php';
require_once 'IniciativaSector.php';
require_once 'Sector.php';
require_once 'IniciativaPublico.php';
require_once 'Publico.php';
require_once 'IniciativaLocalizacion.php';

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Iniciativa
 *
 * @author ariel
 */

class Application_Model_dbTable_Iniciativa extends Zend_Db_Table_Abstract {

    protected $_name = 'iniciativa';
    protected $_rowClass = 'Application_Model_dbTable_IniciativaRow';
     
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'Analizado' => array(
            'columns' => array('analizado_id'),
            'refTableClass' => 'Application_Model_dbTable_Analizado'
        ),
        
    );
    protected $_dependentTables = array('Application_Model_dbTable_IniciativaSector','Application_Model_dbTable_IniciativaPublico','Application_Model_dbTable_IniciativaLocalizacion');  
    
    
}
