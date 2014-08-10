<?php

class ResultsController extends Zend_Controller_Action {
    
    private $_inicFinder;
    
    public function init() {
        
        /* 
         * Estas views serán cargadas dinámicamente por ajax en un div del documento
         * desabilitamos el layout ya que no lo necesitamos
         */
        $this->_helper->layout()->disableLayout();
        
    }

    public function indexAction() {
        // action body
    }

    
    public function abcAction() {

        $abcQBuilder = new Application_Model_IniciativaFinder_ABCQBuilder();
        
        $results = $this->getResults($abcQBuilder);
        
        $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results);
        
        $this->view->assign(array('iniciativas' => $iniciativasToArray, 'paginator' => $results ));

    }
    
    public function localizacionAction() {
        
        $localizacionQBuilder = new Application_Model_IniciativaFinder_LocalizacionQBuilder();
        
        $results = $this->getResults($localizacionQBuilder);
        
        if ($this->_request->getParam('localizacion')) {
            $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results);
            $this->_helper->viewRenderer('abc');
        } else if ($this->_request->getParam('pais')) {
            $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results,'localizacion');
        } else if ($this->_request->getParam('continente')) {
            $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results,'pais');
        }else {
            $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results,'continente');
        }
       
        
        $this->view->assign(array('iniciativas' => $iniciativasToArray, 'paginator' => $results ));
        
    }

    public function publicoAction() {
        
        $publicoQBuilder = new Application_Model_IniciativaFinder_PublicoQBuilder();
        
        $results = $this->getResults($publicoQBuilder);
        
        $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results,'publico');
        
        $this->view->assign(array('iniciativas' => $iniciativasToArray, 'paginator' => $results ));
        
             
    }

    public function sectorAction() {
        
        $sectorQBuilder = new Application_Model_IniciativaFinder_SectorQBuilder();
        
        $results = $this->getResults($sectorQBuilder);
        
        $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results,'sector');
        
        $this->view->assign(array('iniciativas' => $iniciativasToArray, 'paginator' => $results ));
           
    }

    
    
    
    private function getResults($queryBuilder) {
        
        Application_Model_IniciativaFinder_IniciativaFinder::createQuery($queryBuilder,$this->_request->getParams());

        
        $pag_adapter = new Zend_Paginator_Adapter_DbTableSelect($queryBuilder->getQuery());
        $results = new Zend_Paginator($pag_adapter);
        $results->setItemCountPerPage(10);
        
        if ($this->_request->getParam('page')) {
            $results->setCurrentPageNumber($this->_request->getParam('page'));
        }else{
            $results->setCurrentPageNumber(1);
        }
        return $results;
    }
    
}
