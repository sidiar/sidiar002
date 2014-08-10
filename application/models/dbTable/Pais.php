<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dbPais
 *
 * @author ariel
 */
class Application_Model_dbTable_Pais extends Zend_Db_Table_Abstract {

    protected $_name = 'localizacion';
     
    protected $_primary = 'id';
    protected $_referenceMap = array(
        'Continente' => array(
            'columns' => array('continente_id'),
            'refTableClass' => 'Application_Model_dbTable_Continente'
        )
    );
    protected $_dependentTables = array('Application_Model_dbTable_Localizacion');  
    
    
}