<?php

require_once '/Users/ariel/magnet/ship2b/06_WWW/Map/application/models/IniciativaFinder/IniciativaFinder.php';


require_once 'DatabaseTestCase.php';
/*
 * 
 * /usr/local/php5/bin/phpunit  /Users/ariel/magnet/ship2b/06_WWW/Map/tests/application/models/IniciativaFinderTest.php
 * 
 * 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaFinderTest
 *
 * @author ariel
 */
class IniciativaFinderTest extends My_Test_PHPUnit_DatabaseTestCase {

    //put your code here

    /* Builders */
    private $_abcOrderQBuilder;
    private $_localizacionOrderQBuilder;
    private $_sectorOrderQBuilder;
    private $_publicoOrderQBuilder;



    /* Iniciativa Table Gateway */
    private $_dbIniciativa;

    protected function setUp() {
        parent::setUp();


        $this->_abcOrderQBuilder = new Application_Model_IniciativaFinder_ABCQBuilder();

        $this->_sectorOrderQBuilder = new Application_Model_IniciativaFinder_SectorQBuilder();
        
        $this->_publicoOrderQBuilder = new Application_Model_IniciativaFinder_PublicoQBuilder();
        


        $this->_localizacionOrderQBuilder = new Application_Model_IniciativaFinder_LocalizacionQBuilder();


        $this->_dbIniciativa = new Application_Model_dbTable_Iniciativa();
    }

    protected function getDataSet() {
        //    return $this->createMySQLXMLDataSet(APPLICATION_PATH . '/../tests/data/contenidos.xml');
        $dataSet = new PHPUnit_Extensions_Database_DataSet_CsvDataSet();
        $dataSet->addTable('analizado', APPLICATION_PATH . '/../tests/data/csv/analizado_view.csv');
        $dataSet->addTable('continente', APPLICATION_PATH . '/../tests/data/csv/continente_view.csv');
        $dataSet->addTable('iniciativa', APPLICATION_PATH . '/../tests/data/csv/iniciativa_view.csv');
        $dataSet->addTable('iniciativa_localizacion', APPLICATION_PATH . '/../tests/data/csv/iniciativa_localizacion_view.csv');
        $dataSet->addTable('iniciativa_publico', APPLICATION_PATH . '/../tests/data/csv/iniciativa_publico_view.csv');
        $dataSet->addTable('iniciativa_sector', APPLICATION_PATH . '/../tests/data/csv/iniciativa_sector_view.csv');
        $dataSet->addTable('localizacion', APPLICATION_PATH . '/../tests/data/csv/localizacion_view.csv');
        $dataSet->addTable('publico', APPLICATION_PATH . '/../tests/data/csv/publico_view.csv');
        $dataSet->addTable('sector', APPLICATION_PATH . '/../tests/data/csv/sector_view.csv');
        $dataSet->addTable('user', APPLICATION_PATH . '/../tests/data/csv/user_view.csv');

        return $dataSet;
    }

    private function getResults($builder, $filters = array()) {
        Application_Model_IniciativaFinder_IniciativaFinder::createQuery($builder, $filters);
        $searchQuery = $builder->getQuery();
        return $this->_dbIniciativa->fetchAll($searchQuery);
    }

    /* se utiliza para comparar cadenas y chequear el orden */

    private function _utf_fix($cadena) {
        // return strtolower( utf8_encode($cadena));
        /*
          echo "nombre: " . $cadena . "\n";
          echo "nombre: " . htmlentities($cadena) . "\n";
          echo "nombre: " .  html_entity_decode(htmlentities(strtolower($cadena)),ENT_QUOTES,'UTF-8') . "\n";
          echo "nombre: " .  utf8_encode(strtolower($cadena)) . "\n\n\n";
         */

        // return strtolower( html_entity_decode(htmlentities($cadena),ENT_QUOTES,'UTF-8'));
        return $this->_normaliza(utf8_encode(strtolower($cadena)));

//        return $this->_normaliza($cadena);
    }

    /* sustituye acentos por su correspondiente caracter para que no fallen las comparaciones de cadenas */

    private function _normaliza($cadena) {
        $originales = 'ÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝÞßàáâãäåæçèéêëìíîïðñòóôõöøùúûýýþÿŔŕ';
        $modificadas = 'aaaaaaaceeeeiiiidnoooooouuuuybsaaaaaaaceeeeiiiidnoooooouuuyybyRr';
        $cadena = utf8_decode($cadena);
        $cadena = strtr($cadena, utf8_decode($originales), $modificadas);
        $cadena = strtolower($cadena);
        return utf8_encode($cadena);
    }

    /*
     *  TEST ORDER ABC 
     */

    public function testOrderABC() {


        $results = $this->getResults($this->_abcOrderQBuilder);

        $this->assertCount(334, $results);


        $iniciativa = $results->current();

        $this->assertEquals(13999, $iniciativa->id);
//        $this->assertEquals('1x1 MicrocrËdit', $iniciativa->nombre);
        $this->assertEquals('http://www.1x1microcredit.org/', $iniciativa->url);
//        $this->assertEquals('Facilita el acceso al microcrÈdito incorporando un mecanismo persona a persona, que permite vincular pequeÒos inversores con personas microemprendedores.', $iniciativa->descripcion);
        $this->assertEquals(0, $iniciativa->replicable);
        $this->assertEquals(0, $iniciativa->status);
        $this->assertEquals('Laia Oto Llorens', $iniciativa->emprendedor);
        $this->assertEquals('', $iniciativa->observaciones);
        $this->assertEquals(0, $iniciativa->twitteado);
//        $this->assertEquals('2014-02-14 12:08:32', $iniciativa->fecha_alta);
        $this->assertEquals(3, $iniciativa->analizado_id);
        $this->assertEquals(2410, $iniciativa->localizacion_id);

        $this->assertEquals('No', $iniciativa->analizado_descripcion);
        // $this->assertEquals('Catalunya', $iniciativa->localizacion);
        //       $this->assertEquals('EspaÒa', $iniciativa->pais);
        // $this->assertEquals('Europa', $iniciativa->continente);





        /*  Sectores */

        $this->assertCount(2, $iniciativa->sectores);

        $sector0 = $iniciativa->sectores->current();
        $this->assertEquals('Comercio Justo/Local', $sector0->nombre);

        $iniciativa->sectores->next();
        $sector1 = $iniciativa->sectores->current();
        $this->assertEquals('Inclusi&oacute;n', htmlentities($sector1->nombre));


        /*  Targets */

        $this->assertCount(1, $iniciativa->publicos);

        $publico0 = $iniciativa->publicos->current();
        $this->assertEquals('Mujeres', $publico0->nombre);


        /*  Sucursales */

        $this->assertCount(4, $iniciativa->sucursales);

        $sucursal0 = $iniciativa->sucursales->current();
        $this->assertEquals('Renania del Norte-Westfalia', $sucursal0->nombre);
    }

    public function testOrderABC_Sort() {

        $results = $this->getResults($this->_abcOrderQBuilder);

        for ($i = 0; $i < count($results) - 1; $i++) {

            $this->assertGreaterThanOrEqual($this->_utf_fix($results[$i]->nombre), $this->_utf_fix($results[$i + 1]->nombre));
        }
    }

    public function testOrderABC_Filters() {

        /* the request */

        /*
         *  En el controller de Zend se puede obtener los filtros como array asociativo mediante:  
         *  $this->_request->getQuery();
         */


        /*
         *  Se puede chequear que los filtros funcionan para LocalizacionBuilder 
         *  descomentando esta linea
          $this->_abcOrderQBuilder = new Application_Model_IniciativaFinder_LocalizacionQBuilder();
         */

        /* Filtrar por texto abierto */

        $filters = array('text' => 'A Puntadas');
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(1, $results);

        /* -- */

        $filters = array('text' => 'A Putadas');
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(0, $results);

        /* -- */

        $filters = array('text' => 'Catering');
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(6, $results);

        /* -- */

        $filters = array('text' => 'fundaciongizakiaherritar');
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(1, $results);



        /* TEST FILTER CONTINENTE */
        $filters = array('continente' => 1);
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);
        
        $this->assertCount(9, $results);

        /* -- */

        $filters = array('continente' => 2);
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(118, $results);






        /* TEST FILTER PAIS */

        $filters = array('pais' => 2373); /* EEUU */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(84, $results);

        /* -- */

        $filters = array('pais' => 2382); /* ESPAÑA */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(135, $results);



        /* TEST FILTER LOCALIZACION */

        $filters = array('localizacion' => 2410); /* catalunya */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(81, $results);

        /* -- */

        $filters = array('localizacion' => 2399); /* chile -> es pais y debe devolver cero */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(0, $results);



        /* TEXTO + PAIS */

        $filters = array('text' => 'Catering', 'pais' => 2382);
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(5, $results);

        /* -- */

        $filters = array('text' => 'Catering', 'pais' => 2382);
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(5, $results);


        /* SECTOR */

        $filters = array('sector' => 2069); /* cultura */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(7, $results);

        /* -- */

        $filters = array('sector' => 2073); /* dependencia */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(13, $results);

        /* -- */

        $filters = array('sector' => array(2069, 2073)); /* cultura + dependencia */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(20, $results);

        /* -- */

        $filters = array('sector' => array(2069, 2073), 'localizacion' => 2410); /* cultura + dependencia + catalunya */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(10, $results);



        /* PUBLICO */

        $filters = array('publico' => 531); /* inmigrantes */
        $results = $this->getResults($this->_abcOrderQBuilder, $filters);

        $this->assertCount(3, $results);
    }

    /*
     *  TEST ORDER LOCALIZACION 
     */

    public function testOrderLocalizacion_Sort() {

        $results = $this->getResults($this->_localizacionOrderQBuilder);

        $loc2 = null;
        foreach ($results as $iniciativa) {

            $loc1 = $this->_utf_fix($iniciativa->continente) . " (de) > ";
            $loc1 .= $this->_utf_fix($iniciativa->pais) . " > ";
            $loc1 .= $this->_utf_fix($iniciativa->localizacion);

            if (!empty($loc2)) {
                $this->assertGreaterThanOrEqual($loc2, $loc1);
            }

            $loc2 = $loc1;
        }
    }

    
    
    /*
     *  TEST ORDER SECTOR 
     */

    public function testOrderSector_Sort() {

        $results = $this->getResults($this->_sectorOrderQBuilder);

        for ($i = 0; $i < count($results) - 1; $i++) {
            //echo "Sector: " . $results[$i]->sector . "\n";
            $this->assertGreaterThanOrEqual($this->_utf_fix($results[$i]->sector), $this->_utf_fix($results[$i + 1]->sector));
        }
    }
    
    public function testOrderSector_Filters() {
    
        
        /* Filtrar por texto abierto */

        $filters = array('text' => 'Alliance');
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(1, $results);
        $this->assertEquals(14210,$results->current()->id);

        /* -- */

        $filters = array('text' => 'A Putadas');
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(0, $results);
        
        /* -- */

        $filters = array('text' => 'Catering');
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(15, $results);

        /* -- */

        $filters = array('text' => 'fundaciongizakiaherritar');
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(3, $results);
        



        /* TEST FILTER CONTINENTE */
        
        $filters = array('continente' => 1);
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);
//echo $this->_sectorOrderQBuilder->__toString();
        $this->assertCount(14, $results);

        /* -- */

        $filters = array('continente' => 2);
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(171, $results);






        /* TEST FILTER PAIS */

        $filters = array('pais' => 2373); /* EEUU */
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(123, $results);

        /* -- */

        $filters = array('pais' => 2382); /* ESPAÑA */
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(204, $results);



        /* TEST FILTER LOCALIZACION */

        $filters = array('localizacion' => 2410); /* catalunya */
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(126, $results);

        /* -- */

        $filters = array('localizacion' => 2399); /* chile -> es pais y debe devolver cero*/ 
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(0, $results);



        /* TEXTO + PAIS */

        $filters = array('text' => 'Catering', 'pais' => 2382);
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(13, $results);

        


        /* SECTOR */

        $filters = array('sector' => 2069); /* cultura*/
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(7, $results);

        /* -- */

        $filters = array('sector' => 2073); /* dependencia*/
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(13, $results);

        $filters = array('sector' => array(2069,2073)); /* cultura + dependencia*/
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(20, $results);

        /* -- */
        
        $filters = array('sector' => array(2069,2073), 'localizacion' => 2410); /* cultura + dependencia + catalunya*/
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(10, $results);

        

        /* PUBLICO */

        $filters = array('publico' => 531); /* inmigrantes*/
        $results = $this->getResults($this->_sectorOrderQBuilder, $filters);

        $this->assertCount(3, $results);

        
    }
    
    
    
    /*
     *  TEST ORDER PUBLICO 
     */

    public function testOrderPublico_Sort() {

        $results = $this->getResults($this->_publicoOrderQBuilder);

        for ($i = 0; $i < count($results) - 1; $i++) {
            //echo "Publico: " . $results[$i]->publico . "\n";
            $this->assertGreaterThanOrEqual($this->_utf_fix($results[$i]->publico), $this->_utf_fix($results[$i + 1]->publico));
        }
    }
    
    
    public function testOrderPublico_Filters() {
    
        /* Filtrar por texto abierto */

        $filters = array('text' => 'Alliance');
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(1, $results);
        $this->assertEquals(14136,$results->current()->id);

        /* -- */

        $filters = array('text' => 'A Putadas');
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(0, $results);
        
        /* -- */

        $filters = array('text' => 'Catering');
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(3, $results);

        /* -- */

        $filters = array('text' => 'fundaciongizakiaherritar');
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(0, $results);
        



        /* TEST FILTER CONTINENTE */
        
        $filters = array('continente' => 1);
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);
//echo $this->_publicoOrderQBuilder->__toString();
        $this->assertCount(4, $results);

        /* -- */

        $filters = array('continente' => 2);
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(49, $results);






        /* TEST FILTER PAIS */

        $filters = array('pais' => 2373); /* EEUU */
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(32, $results);

        /* -- */

        $filters = array('pais' => 2382); /* ESPAÑA */
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(86, $results);



        /* TEST FILTER LOCALIZACION */

        $filters = array('localizacion' => 2410); /* catalunya */
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(47, $results);

        /* -- */

        $filters = array('localizacion' => 2399); /* chile -> es pais y debe devolver cero*/ 
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(0, $results);



        /* TEXTO + PAIS */

        $filters = array('text' => 'Catering', 'pais' => 2382);
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(2, $results);

        


        /* SECTOR */

        $filters = array('sector' => 2069); /* cultura*/
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(3, $results);

        /* -- */

        $filters = array('sector' => 2073); /* dependencia*/
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(15, $results);

        $filters = array('sector' => array(2069,2073)); /* cultura + dependencia*/
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(18, $results);

        /* -- */
        
        $filters = array('sector' => array(2069,2073), 'localizacion' => 2410); /* cultura + dependencia + catalunya*/
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(9, $results);

        

        /* PUBLICO */

        $filters = array('publico' => 531); /* inmigrantes*/
        $results = $this->getResults($this->_publicoOrderQBuilder, $filters);

        $this->assertCount(3, $results);
    }
    
    function testZendPaginator() {
        
        Application_Model_IniciativaFinder_IniciativaFinder::createQuery($this->_abcOrderQBuilder, array());
        
        $pag_adapter = new Zend_Paginator_Adapter_DbTableSelect($this->_abcOrderQBuilder->getQuery());
        $results = new Zend_Paginator($pag_adapter);
        $results->setCurrentPageNumber(1);
        $results->setItemCountPerPage(10);
        
        $this->assertCount(34, $results);
        
    }
    
    function testPaginatorAndArray() {
        
        $filters = array('localizacion' => 2410); /* catalunya */
        
        Application_Model_IniciativaFinder_IniciativaFinder::createQuery($this->_sectorOrderQBuilder, $filters);
        
        $pag_adapter = new Zend_Paginator_Adapter_DbTableSelect($this->_sectorOrderQBuilder->getQuery());
        $results = new Zend_Paginator($pag_adapter);
        $results->setCurrentPageNumber(1);
        $results->setItemCountPerPage(10);
        
        // $this->assertCount(34, $results);
       // echo var_dump($results);
        $grouped_results = Application_Model_IniciativasUtils::toArray($results,'sector');
        
        foreach($grouped_results as $sector => $iniciativas ) {
            echo $sector . " : " . count($grouped_results[$sector]) . "\n";
        }
        $this->assertCount(1, $grouped_results);
        //$this->assertCount(10, $grouped_results['Alimentación']);
  
 
    }
    
    
    
}
