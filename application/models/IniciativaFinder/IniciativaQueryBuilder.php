<?php

/**
 * Define una interface para crear una query de iniciativas.
 * 
 * Configura la query en funcion del orden, agrupamiento y aplica filtros.
 * En el Builder pattern cumple el rol del Builder.
 * 
 * @author  ariel
 * @link    http://en.wikipedia.org/wiki/Builder_pattern Builder Pattern (GoF) 
 * @package IniciativaFinder
 */

interface IniciativaQueryBuilder {
    
    const FILTER_TEXT = 'filter_text';
    const FILTER_CONTINENTE = 'filter_continente';
    const FILTER_PAIS = 'filter_pais';
    const FILTER_LOCALIZACION = 'filter_localizacion';
    const FILTER_SECTOR = 'filter_sector';
    const FILTER_PUBLICO = 'filter_publico';

    
    /**
     * Inicializa la consulta sin aplicar ningún tipo de filtro.
     * 
     * Puede ser llamado desde el constructor de la clase concreta.
     */
    public function initQuery();
    
    
    /**
     * Agrega un filtro a la consulta.
     * 
     * @param string $filter_type Tipo de filtro definido en las constantes de la interface \IniciativaQueryBuilder.
     * @param mixed $value Valor del filtro a aplicar.
     * @throws InvalidArgumentException Si el parámetro recibido no esta entre los filtros especificados en las constantes.
     */
    public function applyFilter($filter_type,$value);
        
    
    /**
     * Devuelve el objeto Zend_Db_Select de la consulta
     * 
     * @return Zend_Db_Select
     */
    public function getQuery();
    
    
    /**
     * Hace un reset de todos los filtros de la consulta.
     */
    public function clearFilters();
    
}
