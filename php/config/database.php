<?php

/**
 * PDO configuration parameters
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 * @return array db_config
 */
function db_config() {
    return array(
        'host' => 'localhost',
        'driver' => 'mysql',
        'dbname' => 'nation',
        'username' => 'root',
        'password' => ''
    );
}

