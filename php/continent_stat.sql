DROP TABLE IF EXISTS continent_stats;
CREATE TABLE continent_stats (
    continent_id int,
    year int,
    gdp decimal(17,0),
    population int,
    primary key (continent_id, year),
    foreign key(continent_id) references continents(continent_id)	
); 