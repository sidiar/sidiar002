<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaSucursal
 *
 * @author ariel
 */
class Application_Model_dbTable_IniciativaLocalizacion extends Zend_Db_Table_Abstract {
    
    protected $_name="iniciativa_localizacion";
    protected $_primary="id";
    
    protected $_referenceMap    = array(
        'Iniciativa' => array(
            'columns'           => array('id_iniciativa'),
            'refTableClass'     => 'Application_Model_dbTable_Iniciativa',
            'refColumns'        => array('id')
        ),
        'Localizacion' => array(
            'columns'           => array('id_localizacion'),
            'refTableClass'     => 'Application_Model_dbTable_Localizacion',
            'refColumns'        => array('id')
        )
    );
}
