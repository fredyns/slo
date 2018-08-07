
INSERT INTO
	`location_place_lang`
    (`place_id`, `language`, `name`)
    
SELECT
	`id`, 'id-id', `search_name`
    
FROM
	`location_place`
    
WHERE
	`id` > 2