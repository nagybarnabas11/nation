<?php
require_once 'services/Db.php';
require_once './model/ContinentStatModel.php';

/**
 * Generate continent statistics
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
try {
    $db = new Db();
    $model = new ContinentStatModel($db);
    
    $stats = $model->getCountryStats();
    $db->beginTransaction();
    if($model->insert($stats)) {
        $db->commit();
        echo('Success');
    } else {
        echo('Fail');
        $db->rollBack();
    }
    
} catch (Exception $exc) {
    
    echo "Database connection failed: " . $exc->getMessage();
}

