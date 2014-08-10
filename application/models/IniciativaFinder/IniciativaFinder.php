<?php

/**
 * Construye una query de iniciativas utilizando la interface IniciativaQueryBuilder
 * 
 * Su objetivo es utilizar el mismo proceso de creación de queries para todos los tipos de búsqueda de iniciativas.
 * En el Builder pattern  cumple el rol del Director
 * 
 * @author  ariel
 * @link    http://en.wikipedia.org/wiki/Builder_pattern GoF
 * @package IniciativaFinder
 */
class Application_Model_IniciativaFinder_IniciativaFinder {
    
    
    /**
     * Crea una consulta utilizando la interface IniciativaQueryBuilder en el objeto recibido y aplica filtros.
     * 
     * Verifica qué filtros se deben aplicar y los ejecuta en el Builder.
     * 
     * @param IniciativaQueryBuilder $iniciativasQBuilder   Objeto que construye la consulta. El objeto ser recibo por referencia.
     * @param array $filters    Array Asociativo: Las claves son los tipos de filtros y los valores a aplicar
     */
    static function createQuery(&$iniciativasQBuilder,$filters=array()) {
        
        $iniciativasQBuilder->clearFilters();
        
        
        /* -- Apply filters -- */
        
        if (!empty($filters['text'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_TEXT, $filters['text']);
        }
        
       
        /* Filtros de localización: Localizacion, Pais, Continente */
        if (!empty($filters['localizacion'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_LOCALIZACION, $filters['localizacion']);
        } elseif (!empty($filters['pais'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_PAIS, $filters['pais']);
        } elseif (!empty($filters['continente'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_CONTINENTE, $filters['continente']);
        }

        /* Filtros de sectores */
        if (!empty($filters['sector'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_SECTOR, $filters['sector']);
        }

        /* Filtros de targets */
        if (!empty($filters['publico'])) {
            $iniciativasQBuilder->applyFilter($iniciativasQBuilder::FILTER_PUBLICO, $filters['publico']);
        }
        
        
    }
    
}
