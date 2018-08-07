/**
 * This commands will empty the sublocation-counter and recount all sublocation for every place.
 */

TRUNCATE `location_sublocation_counter`;

INSERT INTO
	`location_sublocation_counter`
    (`sublocation_of`, `type_id`, `quantity`)

SELECT
	`sublocation_of`,
    `type_id`,
	COUNT(*) qty

FROM 
	`location_place` 
    
WHERE
	`sublocation_of` IS NOT NULL
AND
	`type_id` IS NOT NULL
    
GROUP BY
	`sublocation_of`,
    `type_id`
;