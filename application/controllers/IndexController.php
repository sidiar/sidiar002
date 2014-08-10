<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
    }

    public function indexAction()
    {
        
        /*
         * Get Sectores para los filtros
         */
        $dbSector =  new Application_Model_dbTable_Sector();
        $sectores_query = $dbSector->select()->order("nombre");
        $sectores = $dbSector->fetchAll($sectores_query);
        
        /*
         * Get Targets para los filtros
         */
        $dbTargets = new Application_Model_dbTable_Publico();
        $dbTargets_select = $dbTargets->select()->order("nombre");
        $targets = $dbTargets->fetchAll($dbTargets_select);
        
        
        /*
         * Get Iniciativas por defecto: Orden ABC, luego se cargarán dinámicamente x llamadas ajax
         */
        $sectorOrderQBuilder = new Application_Model_IniciativaFinder_ABCQBuilder();
        
        Application_Model_IniciativaFinder_IniciativaFinder::createQuery($sectorOrderQBuilder);
        
        $pag_adapter = new Zend_Paginator_Adapter_DbTableSelect($sectorOrderQBuilder->getQuery());
        $results = new Zend_Paginator($pag_adapter);
        $results->setCurrentPageNumber(1);
        $results->setItemCountPerPage(10);

        $iniciativasToArray = Application_Model_IniciativasUtils::toArray($results);
        
        $this->view->assign(array('sectores' => $sectores, 'targets' => $targets, 'iniciativas' => $iniciativasToArray, 'paginator' => $results ));
    }


}

