<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaSector
 *
 * @author ariel
 */

class Application_Model_dbTable_IniciativaSector extends Zend_Db_Table_Abstract
{
 protected $_name = 'iniciativa_sector';
 protected $_primary = 'id';
 
 protected $_referenceMap    = array(
        'Iniciativa' => array(
            'columns'           => array('id_iniciativa'),
            'refTableClass'     => 'Application_Model_dbTable_Iniciativa',
            'refColumns'        => array('id')
        ),
        'Sector' => array(
            'columns'           => array('id_sector'),
            'refTableClass'     => 'Application_Model_dbTable_Sector',
            'refColumns'        => array('id')
        )
    );
}
