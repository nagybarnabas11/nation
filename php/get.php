<?php

require_once 'services/Db.php';
require_once './model/ContinentStatModel.php';

/**
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
try {
    $db = new Db();
    $continent = isset($_GET['continent']) ? $_GET['continent'] : null;
    $year = $_GET['year'];
    $gdp_order = $_GET['gdp_order'];
    $model = new ContinentStatModel($db);
    echo json_encode($model->readContinentStats($year, $continent, $gdp_order));
} catch (Exception $exc) {
    echo "Database connection failed: " . $exc->getMessage();
}


