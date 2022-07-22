<?php
require_once 'Model.php';

/**
 * Model for getting continents from database
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
class ContinentModel extends Model{
    
    public function __construct(Db $db) {
        parent::__construct($db);
    }
    
    private static $getContinentsQuery = 'SELECT continent_id as id, name from continents';
    
    /**
     * list all continents with name and id
     * @return array continents
     */
    public function getContinents() {
        $this->db->select(self::$getContinentsQuery);
        return $this->db->get();
    }
}
