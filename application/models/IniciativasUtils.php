<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of IniciativaToArray
 *
 * @author ariel
 */
class Application_Model_IniciativasUtils {
   
    
    static function toArray($iniciativas, $groupField='') {
       
        
        $results = array();
        
        foreach ($iniciativas as $iniciativa) {
            
            /*
             * Obtengo el array de la iniciativa
             */
            
            /* en php 5.5 se puede utilizar array_column para hacer esto mismo */
            $iniSectores = array();
            foreach ($iniciativa->sectores as $sector) {
                $iniSectores[] = $sector->nombre;
            }
            
            /* en php 5.5 se puede utilizar array_column para hacer esto mismo */
            $iniPublicos = array();
            foreach ($iniciativa->publicos as $publico) {
                $iniPublicos[] = $publico->nombre;
            } 
            
            /* en php 5.5 se puede utilizar array_column para hacer esto mismo */
            
            $iniSucursales = array();
            foreach ($iniciativa->sucursales as $sucursal) {
                // echo var_dump($sucursal->findDependentRowset('Application_Model_dbTable_SucursalPais','Pais'));
                $pais =  $sucursal->findParentRow('Application_Model_dbTable_Pais');
                // 
                // echo "<br><br><br>";
                $iniSucursales[] = $sucursal->nombre . ', ' . $pais->nombre;
            } 
            
            
            $iniciativaToArray =  array (
                'id' => $iniciativa->id,  
                'nombre' => $iniciativa->nombre,  
                'descripcion' => $iniciativa->descripcion,
                'url' => $iniciativa->url,
                'sectores' => implode(', ',$iniSectores),
                'publicos' => implode(', ',$iniPublicos),
                'sucursales' => implode(' / ',$iniSucursales)
            );
            

            /*
             * Si hay un campo de agrupamiento voy creando un array asociativo por este campo
             */
            
            if (!empty($groupField)) {
                $results[$iniciativa->$groupField][] = $iniciativaToArray;
            }else{
                $results[] = $iniciativaToArray;
            }
                    
        }
        return $results;
    }
    
    
}
