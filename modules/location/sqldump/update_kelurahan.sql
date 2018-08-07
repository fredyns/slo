UPDATE
	`location_place` kelurahan

INNER JOIN
	`location_place` kecamatan
ON
	kelurahan.`sublocation_of` = kecamatan.id
    
INNER JOIN
	`location_place` regency
ON
	kecamatan.`sublocation_of` = regency.id
    
SET
	kelurahan.`type_id` = 7

WHERE
	regency.`type_id` = 4
	