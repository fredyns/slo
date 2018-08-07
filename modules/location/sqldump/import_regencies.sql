
INSERT INTO
	`location_place`
    (`region_code`, `type_id`, `search_name`, `sublocation_of`)
    
SELECT
	`regencies`.`id`,
    4,
    `regencies`.`name`,
    `location_place`.`id`
FROM
	`regencies`
INNER JOIN
	`location_place`
ON
	`regencies`.`province_id` = `location_place`.`region_code`
    