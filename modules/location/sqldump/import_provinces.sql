/**
 * province ID 31 (Jakarta) inserted manually
 */
INSERT INTO
	`location_place`
    (`region_code`, `type_id`, `search_name`, `sublocation_of`)
    
SELECT
	`id`, 3, `name`, 1
    
FROM
	`provinces`
    
WHERE
	`id` != '31'