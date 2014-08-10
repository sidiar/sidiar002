<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaPublico
 *
 * @author ariel
 */
class Application_Model_dbTable_IniciativaPublico extends Zend_Db_Table_Abstract {
    
    protected $_name="iniciativa_publico";
    protected $_primary="id";
    
    protected $_referenceMap    = array(
        'Iniciativa' => array(
            'columns'           => array('id_iniciativa'),
            'refTableClass'     => 'Application_Model_dbTable_Iniciativa',
            'refColumns'        => array('id')
        ),
        'Publico' => array(
            'columns'           => array('id_publico'),
            'refTableClass'     => 'Application_Model_dbTable_Publico',
            'refColumns'        => array('id')
        )
    );
}
