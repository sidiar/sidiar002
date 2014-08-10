<?php

require_once 'IniciativaQueryBuilder.php';

/**
 * Crea una query de iniciativas ordenadas por nombre de la iniciativa implementando la interface IniciativaQueryBuilder
 *
 * En el Builder pattern cumple el rol del ConcreteBuilder
 * 
 * @author  ariel
 * @link    http://en.wikipedia.org/wiki/Builder_pattern Builder Pattern (GoF) 
 * @package IniciativaFinder
 */

class Application_Model_IniciativaFinder_ABCQBuilder implements IniciativaQueryBuilder {
    
    /**
     * @var Zend_Db_Select
     */
    private $_query;
    
    function __construct() {
        
        $this->initQuery();
        
    }
    
    /**
     * Inicializa la consulta sin aplicar ningún tipo de filtro.
     * 
     * Puede ser llamado desde el constructor de la clase.
     */
    function initQuery() {

        $dbIniciativa = new Application_Model_dbTable_Iniciativa();

        $this->_query = $dbIniciativa->select()->setIntegrityCheck(false)
                ->from(array('i' => 'iniciativa'))
                ->join(array('a' => 'analizado'), 'i.analizado_id = a.id', array("analizado_descripcion" => "a.descripcion"))
                ->order('i.nombre');

    }
    
    /**
     * Devuelve el objeto Zend_Db_Select de la consulta
     * 
     * @return Zend_Db_Select
     */
    function getQuery() {
        return $this->_query;
    }
    
    /**
     * Agrega un filtro a la consulta.
     * 
     * @param string $filter_type Tipo de filtro definido en las constantes de la interface \IniciativaQueryBuilder.
     * @param mixed $value Valor del filtro a aplicar.
     * @throws InvalidArgumentException Si el parámetro recibido no esta entre los filtros especificados en las constantes.
     */
    function applyFilter($filter_type, $value) {

        switch ($filter_type) {
            case self::FILTER_TEXT:
                $this->_query->where('i.nombre like ? OR i.descripcion like ? OR i.url like ? ', '%' . $value . '%');
                break;

            case self::FILTER_CONTINENTE:
                $iniciativaLocalizacion = new Application_Model_dbTable_IniciativaLocalizacion;
                $subquery = $iniciativaLocalizacion->select()
                        ->from(array('il' => 'iniciativa_localizacion'), array('id' => 'il.id_iniciativa'))
                        ->join(array('l' => 'localizacion'), 'il.id_localizacion = l.id',array())
                        ->join(array('p' => 'localizacion'), 'l.parent_id = p.id',array())
                        ->where('p.continente_id IN ( ? )', $value);

                $this->_query->where('i.id IN ( ? )', $subquery);

                break;
            

            case self::FILTER_PAIS:
                $iniciativaLocalizacion = new Application_Model_dbTable_IniciativaLocalizacion;
                $subquery = $iniciativaLocalizacion->select()
                        ->from(array('il' => 'iniciativa_localizacion'), array('id' => 'il.id_iniciativa'))
                        ->join(array('l' => 'localizacion'), 'il.id_localizacion = l.id',array())
                        ->where('l.parent_id IN ( ? )', $value);

                $this->_query->where('i.id IN ( ? )', $subquery);

                break;
            

            case self::FILTER_LOCALIZACION:
                $iniciativaLocalizacion = new Application_Model_dbTable_IniciativaLocalizacion;
                $subquery = $iniciativaLocalizacion->select()
                        ->from(array('il' => 'iniciativa_localizacion'), array('id' => 'il.id_iniciativa'))
                        ->where('il.id_localizacion IN ( ? )', $value);

                $this->_query->where('i.id IN ( ? )', $subquery);

                break;
            

            case self::FILTER_SECTOR:

                $iniciativaSector = new Application_Model_dbTable_IniciativaSector;
                $subquery = $iniciativaSector->select()
                        ->from(array('is' => 'iniciativa_sector'), array('id' => 'is.id_iniciativa'))
                        ->where('is.id_sector IN ( ? )', $value);

                $this->_query->where('i.id IN ( ? )', $subquery);

                break;

            case self::FILTER_PUBLICO:

                $iniciativaPublico = new Application_Model_dbTable_IniciativaPublico;
                $subquery = $iniciativaPublico->select()
                        ->from(array('ip' => 'iniciativa_publico'), array('id' => 'ip.id_iniciativa'))
                        ->where('ip.id_publico IN ( ? )', $value);

                $this->_query->where('i.id IN ( ? )', $subquery);

                break;

            default:
                throw new \InvalidArgumentException("$filter_type must be a valid order criteria");
        }
    }
    
    /**
     * Hace un reset de todos los filtros de la consulta.
     */
    function clearFilters() {
        $this->_query->reset('where');
    }
    
    /**
     * Devuelve la cadena SQL de la consulta.
     * 
     * Se utiliza para facilitar el testing y debugging.
     */
    function __toString() {
        return $this->_query->__toString();
    }
}
