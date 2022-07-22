<?php

require_once __DIR__.'/../config/database.php';
/**
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 * @extends PDO
 * Database connection
 */
class Db extends PDO{
    
    private $stmt;
    
    public function __construct() {
        $db_config = db_config();
        return parent::__construct($db_config['driver'] .  ":host=" . $db_config['host'] . ";dbname=" . $db_config['dbname'], $db_config['username'], $db_config['password']);
    }
    
    /**
     * select query
     * @param string $sql
     * @return PDOStatement statement
     */
    public function select($sql) {
        $this->stmt = parent::query($sql);
        return $this->stmt;
    }
    
    /*
     * fetch result as associative array
     * @return array result
     */
    public function get() {
        return $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    
    /**
     * Insert one row
     * @param string $sql
     * @param array $row
     * @return boolean success of the insert
     */
    public function insert($sql, $row) {
        $this->prepare($sql);
        $this->stmt= $this->prepare($sql);
        return $this->execute($row);
    }
    
    /**
     * Insert multiple rows
     * @param type $sql
     * @param type $data
     * @return boolean success of the insert
     */
    public function insertBatch($sql, $data) {
        foreach($data as $row) {
            $this->insert($sql, $row);
        }
        return true;
    }


    private function execute($params) {
        try{
           $this->stmt->execute(array_values($params));
           return true;
        } catch(Exception $exc) {
            return false;
        }
    }
  
}
