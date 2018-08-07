
INSERT INTO
	`location_place`
    (`region_code`, `type_id`, `search_name`, `sublocation_of`)
    
SELECT
	`villages`.`id`,
    8,
    `villages`.`name`,
    `location_place`.`id`
FROM
	`villages`
LEFT JOIN
	`location_place`
ON
	`villages`.`district_id` = `location_place`.`region_code`
    