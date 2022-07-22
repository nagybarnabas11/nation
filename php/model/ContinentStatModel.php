<?php
require_once 'Model.php';

/**
 * Model for writing/reading continent statistics
 * @author Nagy Barnabás <nagybarnabas11@gmail.com>
 */
class ContinentStatModel extends Model 
{
    private static $select = "SELECT continents.continent_id, country_stats.year, sum(country_stats.gdp) as gdp_sum, sum(country_stats.population) as population_sum FROM countries 
            JOIN country_stats ON country_stats.country_id = countries.country_id
            JOIN regions ON regions.region_id = countries.region_id
            JOIN continents  ON continents.continent_id = regions.continent_id
            GROUP BY continents.continent_id, continents.name, country_stats.year
            Order BY country_stats.year DESC";
    
    private static $insertQuery = "INSERT INTO continent_stats VALUES(?, ?, ?, ?)";
    
    public function __construct(Db $db) {
        parent::__construct($db);
    }
    
    /**
     * Get country statistics from db grouped by continents
     * @return array grouped statistics
     */
    public function getCountryStats() {
        $this->db->select(self::$select);
        return $this->db->get();
    }
    
    /*
     * Insert continent statistics record into db
     * @return boolean success of the insert
     */
    public function insert($stats) {
        return $this->db->insertBatch(self:: $insertQuery, $stats);
    }
    
    /**
     * Get 10 years of the continent statistics from given year
     * @param int $year begin year
     * @param int $continent continent id
     * @param string $gdp_order ASC|DESC 
     * @return array continent statistics records
     */
    public function readContinentStats($year, $continent, $gdp_order) {
        $this->db->select($this->getReadSql($year, $continent, $gdp_order));
        return $this->db->get();
    }
    
    private function getReadSql($year, $continent, $gdp_order) {
        $sql = 'SELECT continent_stats.continent_id, continents.name, SUM(continent_stats.gdp) as gdp_sum, SUM(continent_stats.population) as population_sum FROM continent_stats JOIN continents ON continents.continent_id = continent_stats.continent_id';
        $year2 = (int) $year + 10;
        $sql .= ' WHERE continent_stats.year BETWEEN ' . (int) $year . ' AND ' . $year2;
        if($continent > 0) {
            $sql .= ' AND continent_stats.continent_id = ' . (int) $continent;
        }
        $sql .= ' GROUP BY continent_stats.continent_id';
        $sql .= ' ORDER BY gdp_sum ' . $gdp_order;
        return $sql;
    }
    
    
}
