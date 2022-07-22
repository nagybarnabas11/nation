<?php

/**
 * Model for interact with database
 * @property Db $db database connection
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
class Model {
    
    protected $db;
    
    public function __construct(Db $db) {
        $this->db = $db;
    }

}
