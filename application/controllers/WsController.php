<?php


class WsController extends Zend_Controller_Action
{

    public function init()
    {
        
        $this->_helper->layout()->disableLayout();
        Zend_Controller_Front::getInstance()
            ->setParam('noViewRenderer', true);
    }

    public function indexAction()
    {
        // action body
    }
    
    public function paisesAction() {
  
        $continente_id = $this->_request->getParam('continente');
        
        $continentes = new Application_Model_dbTable_Continente();
        
        $continente = $continentes->find($continente_id)->current();
        
        if (count($continente)>0) {
            
            $paises = $continente->findDependentRowset('Application_Model_dbTable_Pais');
            
        } else {
        
            $paises =  array();
            
        }
        
        $return_paises = array();
        for ($i=0;$i<count($paises);$i++) {
            array_push($return_paises, array('id'=> $paises[$i]->id , 'label' => utf8_encode($paises[$i]->nombre) ));
        }

        echo json_encode($return_paises);
    }
    


    public function localizacionesAction() {
  
        $pais_id = $this->_request->getParam('pais');
        
        $paises = new Application_Model_dbTable_Pais();
        
        $pais = $paises->find($pais_id)->current();
        
        if (count($pais)>0) {
            
            $localizaciones = $pais->findDependentRowset('Application_Model_dbTable_Localizacion');
            
        } else {
        
            $localizaciones =  array();
            
        }
        
        $return_locs = array();
        for ($i=0;$i<count($localizaciones);$i++) {
            array_push($return_locs, array('id'=> $localizaciones[$i]->id , 'label' => utf8_encode($localizaciones[$i]->nombre) ));
        }

        echo json_encode($return_locs);
    }    
    
}

