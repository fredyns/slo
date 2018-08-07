
INSERT INTO
	`location_place`
    (`region_code`, `type_id`, `search_name`, `sublocation_of`)
    
SELECT
	`districts`.`id`,
    6,
    `districts`.`name`,
    `location_place`.`id`
FROM
	`districts`
INNER JOIN
	`location_place`
ON
	`districts`.`regency_id` = `location_place`.`region_code`
    