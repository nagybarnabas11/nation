<?php

require_once 'services/Db.php';
require_once './model/ContinentModel.php';

/**
 * Get continents for filter select
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
try {
    $db = new Db();  
    $countryStatModel = new ContinentModel($db);
    echo json_encode($countryStatModel->getContinents());
} catch (Exception $exc) {
    echo "Database connection failed: " . $exc->getMessage();
}