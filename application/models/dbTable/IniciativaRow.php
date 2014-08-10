<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaRow
 *
 * @author ariel
 */
class Application_Model_dbTable_IniciativaRow extends Zend_Db_Table_Row_Abstract {
    
    /*
     * @var Zend_Db_Table_Rowset
     */
    private $_sectores;
    
    /*
     * @var Zend_Db_Table_Rowset
     */
    private $_publicos;
    
    /*
     * @var Zend_Db_Table_Rowset
     */
    private $_sucursales;
    
    
    public function __get($name) {
        
        switch ($name) {
            case 'sectores':
              return $this->_getSectores();
            case 'publicos':                
              return $this->_getPublicos();
            case 'sucursales':                
              return $this->_getSucursales();
          default :
              return parent::__get($name);
        }
        
    }
    
    private function _getSectores(){
        if (empty($this->_sectores)) {
            $this->_sectores = $this->findManyToManyRowset('Application_Model_dbTable_Sector',
                                                 'Application_Model_dbTable_IniciativaSector');
        }
        return $this->_sectores;
    }
    
    private function _getPublicos(){
        if (empty($this->_publicos)) {
            $this->_publicos = $this->findManyToManyRowset('Application_Model_dbTable_Publico',
                                                 'Application_Model_dbTable_IniciativaPublico');
        }
        return $this->_publicos;
    }
    
    private function _getSucursales(){
        if (empty($this->_sucursales)) {
            $this->_sucursales = $this->findManyToManyRowset('Application_Model_dbTable_Localizacion',
                                                 'Application_Model_dbTable_IniciativaLocalizacion');
        }
        return $this->_sucursales;
    }
    
}
