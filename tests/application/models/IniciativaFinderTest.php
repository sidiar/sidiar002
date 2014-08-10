<?php


require_once '/Users/ariel/magnet/ship2b/06_WWW/Map/application/models/IniciativaFinder.php';
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
    
    private $_inicFinder;


     protected function setUp() {
         parent::setUp();
        // $this->_inicFinder = new IniciativaFinder(new IniciativaList(IniciativaList::ORDER_ABC));
     
         $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_ABC);

        // $this->_inicFinder->applyFilters({IniciativaFinder::FILTER_TEXT => 'Amigos'})
         
         
         
    }
 
     protected function getDataSet()
    {
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
    
    
    public function testResults() {
        
        
        
        $this->assertCount(34,$this->_inicFinder->resultList);
        
        $iniciativa = $this->_inicFinder->resultList->getItem(1);
       
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
        $this->assertEquals('Catalunya', $iniciativa->localizacion);
 //       $this->assertEquals('EspaÒa', $iniciativa->pais);
        $this->assertEquals('Europa', $iniciativa->continente);
        

        /*
         * Sectores
         */
        
        $this->assertCount(2,$iniciativa->sectores);
        
        $sector0 = $iniciativa->sectores->current();
        $this->assertEquals('Comercio Justo/Local', $sector0->nombre);
        
        $iniciativa->sectores->next();
        $sector1 = $iniciativa->sectores->current();
        $this->assertEquals('Inclusi&oacute;n', htmlentities($sector1->nombre));
        
        
        /**/
        /*
         * Targets
         */
         
        $this->assertCount(1,$iniciativa->publicos);
        
        $publico0 = $iniciativa->publicos->current();
        $this->assertEquals('Mujeres', $publico0->nombre);
        
        /*
         * Sucursales
         */
        
        $this->assertCount(2,$iniciativa->sucursales);
        
        $sucursal0 = $iniciativa->sucursales->current();
        $this->assertEquals('Eichstetten am Kaiserstuhl', $sucursal0->nombre);

    }
    
    public function testSort() {
        
        
        
        // Test Order default ABC
        //***********************
        
       // echo "test Sort.. ABC";
        
        for ($i=0;$i<count($this->_inicFinder->resultList)-1;$i++) {
            //echo $this->_inicFinder->resultList[$i]->nombre . "\n";
      //      $this->assertGreaterThan( strtolower( htmlentities($this->_inicFinder->resultList[$i]->nombre)),strtolower(htmlentities($this->_inicFinder->resultList[$i+1]->nombre)));
        }

        
        
         
        // Test Order LOCALIZATION
        //*************************
         
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_LOCALIZACION);
        
        // $this->_inicFinder->applySort(new IniciativaList(IniciativaList::ORDER_LOCALIZACION));
        // echo "test Sort.. ORDER_LOCALIZACION \n";
        $loc2 = null;
        foreach ($this->_inicFinder->resultList as $iniciativa) {
            
            $loc1 = strtolower( (htmlentities($iniciativa->continente))) . " (de) > ";
            $loc1 .= strtolower( htmlentities($iniciativa->pais)) . " > ";
            $loc1 .= strtolower( htmlentities($iniciativa->localizacion));            
        
            if (!empty($loc2)) {
                $this->assertGreaterThanOrEqual($loc2,$loc1);
            }
            
            $loc2 = $loc1;
        }
        
        
        
        // Test Order PUBLICO
        //*******************        
        
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_PUBLICO);
        $this->_inicFinder->setPaginator(400);
//        $this->_inicFinder->applySort(new PublicoList());
        $publico2 = null;
        foreach ($this->_inicFinder->resultList as $iniciativa) {
            $publico1 = $iniciativa->publico;
            if (!empty($publico2)) {
                //echo "compare: assertGreaterThanOrEqual($publico1,$publico2) \n";
                //$this->assertGreaterThanOrEqual($publico1,$publico2);
                $this->assertGreaterThanOrEqual($publico2,$publico1);
            }
            $publico2 = $publico1;
        }
        
        
        $agrupado = $this->_inicFinder->toArray('publico');
//        echo "valor: " . $agrupado['Desempleados'][0]->nombre . "\n";
//       echo  var_dump($agrupado);
        $this->assertEquals('A Puntadas', $agrupado['Desempleados'][0]['nombre']);
        $this->assertEquals('Acta Vista', $agrupado['Desempleados'][1]['nombre']);
        $this->assertEquals('Agentura ProVas', $agrupado['Desempleados'][2]['nombre']);

//        $this->assertEquals('A Puntadas', $agrupado['Mujeres'][0]['nombre']);
        $this->assertEquals('Adelante Mujeres', $agrupado['Mujeres'][2]['nombre']);
        $this->assertEquals('Catering Solidario', $agrupado['Mujeres'][3]['nombre']);

        
        
         
        // Test Order SECTOR
        //*******************        
  /*      
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_SECTOR);
        $agrupado = $this->_inicFinder->toArray('sector');
//        $this->_inicFinder->applySort(new PublicoList());
        for ($i=0;$i<count($this->_inicFinder->resultList)-1;$i++) {
            $sector1 = $this->_inicFinder->resultList[$i]->sector;
            $sector2 = $this->_inicFinder->resultList[$i+1]->sector;
            $this->assertGreaterThanOrEqual($sector1,$sector2);
        }
        
        $agrupado = $this->_inicFinder->toArray('sector');
        $this->assertEquals('Core Arts', $agrupado['Cultura'][1]['nombre']);
        $this->assertEquals('Lower Case', $agrupado['Cultura'][2]['nombre']);
        $this->assertEquals('Parallel 40', $agrupado['Cultura'][3]['nombre']);

        $this->assertEquals('Archer', $agrupado['Comercio Justo/Local'][1]['nombre']);
        $this->assertEquals('Bee honey', $agrupado['Comercio Justo/Local'][2]['nombre']);
        $this->assertEquals('Big Issue Invest', $agrupado['Comercio Justo/Local'][3]['nombre']);

   */
        
        
    }

    public function testFilter() {
        
         // Test Order default ABC
        //***********************
        // Test Order LOCALIZATION
        //*************************
        
        /* TEST FILTER TEXT */
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_ABC);
//        $this->_inicFinder = IniciativaFinder::getInstance(IniciativaFinder::ORDER_LOCALIZACION);
        
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'A Puntadas');
        
        $this->assertCount(1,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'A Putadas');

        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        
        $this->assertCount(6,$this->_inicFinder->resultList);
                
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'fundaciongizakiaherritar');
        
        $this->assertCount(1,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER CONTINENTE */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,1);
        
        $this->assertCount(9,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,2);
        
        $this->assertCount(118,$this->_inicFinder->resultList);
        
        
        /* TEST FILTER PAIS */
        $this->_inicFinder->clearFilters(); /* EEUU */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2373);
        
        $this->assertCount(84,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* ESPAÑA */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(135,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER LOCALIZACION */
        $this->_inicFinder->clearFilters(); /* catalunya */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);
        
        $this->assertCount(81,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* chile -> es pais y debe devolver cero*/ 
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2399);
        
        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        /* TEXTO + PAIS */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(5,$this->_inicFinder->resultList);
    
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(5,$this->_inicFinder->resultList);
        
        
        /* SECTOR */
        $this->_inicFinder->clearFilters(); /* cultura*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2069);
        
        $this->assertCount(7,$this->_inicFinder->resultList);
        
        $this->_inicFinder->clearFilters(); /* dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2073);
        
        $this->assertCount(13,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));
        
        $this->assertCount(20,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia + catalunya*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);
        
        $this->assertCount(10,$this->_inicFinder->resultList);
        
        
        
         /* PUBLICO */
        $this->_inicFinder->clearFilters(); /* inmigrantes*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PUBLICO,531);
        
        $this->assertCount(3,$this->_inicFinder->resultList);
        
        
        
        
        
        
        // Test Order SECTOR
        //*************************
        
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_SECTOR);
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Alliance');
        

        $this->assertCount(1,$this->_inicFinder->resultList);
        $this->assertCount(1,$this->_inicFinder->resultList['Medio ambiente']);
        $this->assertEquals(14210,$this->_inicFinder->resultList['Medio ambiente'][0]->id);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'A Putadas');

        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        
        
        $this->assertCount(7,$this->_inicFinder->resultList);
                
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'fundaciongizakiaherritar');
        
        
        $this->assertCount(3,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER CONTINENTE */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,1);
        
       //  echo $this->_inicFinder->__toString() . "\n\n";
       
        $this->assertCount(7,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,2);
        
        $this->assertCount(12,$this->_inicFinder->resultList);
        
        
        /* TEST FILTER PAIS */
        $this->_inicFinder->clearFilters(); /* EEUU */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2373);
      //  echo $this->_inicFinder->__toString() . "\n\n";
        $this->assertCount(11,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* ESPAÑA */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(12,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER LOCALIZACION */
        $this->_inicFinder->clearFilters(); /* catalunya */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);
        
        $this->assertCount(12,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* chile -> es pais y debe devolver cero*/ 
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2399);
        
        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        /* TEXTO + PAIS */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(6,$this->_inicFinder->resultList);
    
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(6,$this->_inicFinder->resultList);
        
        
        /* SECTOR */
        $this->_inicFinder->clearFilters(); /* cultura*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2069);

        $this->assertCount(7,$this->_inicFinder->resultList['Cultura']);
        
        $this->_inicFinder->clearFilters(); /* dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2073);
        
        $this->assertCount(13,$this->_inicFinder->resultList['Dependencia']);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));
        
        $this->assertCount(2,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia + catalunya*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);

        $this->assertCount(2,$this->_inicFinder->resultList);
        
        
        
         /* PUBLICO */
        $this->_inicFinder->clearFilters(); /* inmigrantes*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PUBLICO,531);
   // echo $this->_inicFinder->__toString() . "\n\n";     
        $this->assertCount(3,$this->_inicFinder->resultList);

        
        
        
        // Test Order PUBLICO
        //*************************
        
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_PUBLICO);
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Alliance');
        
//echo $this->_inicFinder->__toString() . "\n\n";     
        $this->assertCount(1,$this->_inicFinder->resultList);
        $this->assertCount(1,$this->_inicFinder->resultList['Personas con discapacidad']);
        $this->assertEquals(14136,$this->_inicFinder->resultList['Personas con discapacidad'][0]->id);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'A Putadas');

        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        
        
        $this->assertCount(2,$this->_inicFinder->resultList);
                
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'fundaciongizakiaherritar');
        
       // echo $this->_inicFinder->__toString() . "\n\n";     
        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER CONTINENTE */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,1);
        
       //  echo $this->_inicFinder->__toString() . "\n\n";
       
        $this->assertCount(3,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_CONTINENTE,2);
        
        $this->assertCount(6,$this->_inicFinder->resultList);
        
        
        /* TEST FILTER PAIS */
        $this->_inicFinder->clearFilters(); /* EEUU */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2373);
      //  echo $this->_inicFinder->__toString() . "\n\n";
        $this->assertCount(6,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* ESPAÑA */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(5,$this->_inicFinder->resultList);
        
        
        
        /* TEST FILTER LOCALIZACION */
        $this->_inicFinder->clearFilters(); /* catalunya */
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);
        
        $this->assertCount(5,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* chile -> es pais y debe devolver cero*/ 
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2399);
        
        $this->assertCount(0,$this->_inicFinder->resultList);
        
        
        /* TEXTO + PAIS */
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(2,$this->_inicFinder->resultList);
    
        
        $this->_inicFinder->clearFilters();
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_TEXT,'Catering');
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PAIS,2382);
        
        $this->assertCount(2,$this->_inicFinder->resultList);
        
        
        /* SECTOR */
        $this->_inicFinder->clearFilters(); /* cultura*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2069);

        $this->assertCount(1,$this->_inicFinder->resultList['Desempleados']);
        
        $this->_inicFinder->clearFilters(); /* dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,2073);
        
        $this->assertCount(7,$this->_inicFinder->resultList['Personas mayores']);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));

        $this->assertCount(5,$this->_inicFinder->resultList);
        
        
        $this->_inicFinder->clearFilters(); /* cultura + dependencia + catalunya*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_SECTOR,array(2069,2073));
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_LOCALIZACION,2410);

        $this->assertCount(5,$this->_inicFinder->resultList);
        
        
        
         /* PUBLICO */
        $this->_inicFinder->clearFilters(); /* inmigrantes*/
        $this->_inicFinder->applyFilter(Application_Model_IniciativaFinder::FILTER_PUBLICO,531);
   // echo $this->_inicFinder->__toString() . "\n\n";     
        $this->assertCount(1,$this->_inicFinder->resultList);
    }
    
    
    public function testPaginator() {
        
        $this->_inicFinder = Application_Model_IniciativaFinder::getInstance(Application_Model_IniciativaFinder::ORDER_ABC);
        
        /* items per page */
        $this->_inicFinder->setPaginator(10);
        
        $this->_inicFinder->setCurrentPageNumber(2);
        
        /*
        echo 'total count: ' . count($this->_inicFinder->resultList);
        
        foreach ($this->_inicFinder->resultList as $item) {
            
            echo $item->nombre . "\n";
        }
        
        echo "page 2\n";
        $this->_inicFinder->setCurrentPageNumber(2);
        foreach ($this->_inicFinder->resultList as $item) {
            
            echo $item->nombre . "\n";
        }*/
        
        
    }
    public function testWS() {
        /*
        $localization = new dbLocalization();
        
        $localization->load*/
    }
    
}
