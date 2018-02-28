SELECT * FROM (
	SELECT
	mapel.id,
	mapel.mapel,
	mapel.kelas_id,
	mapel.guru_id,
	mapel.kelompokmapel_id,
	mapel.parent,
	mapel.parent_id,
	kelompokmapel.kelompokmapel,
	kelompokmapel.semester_id,
	mapel.id AS order_1,
	mapel.id AS order_2
	FROM
	mapel
	INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
	WHERE 
	mapel.parent = 1 AND 
	mapel.kelas_id = 5 AND 
	mapel.semester_id = 2 


	UNION ALL

	SELECT
	mapel.id,
	mapel.mapel,
	mapel.kelas_id,
	mapel.guru_id,
	mapel.kelompokmapel_id,
	mapel.parent,
	mapel.parent_id,
	kelompokmapel.kelompokmapel,
	kelompokmapel.semester_id,
	mapel.parent_id AS order_1,
	mapel.id AS order_2
	FROM
	mapel
	INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
	WHERE 
	mapel.parent = 0 AND 
	mapel.kelas_id = 5 AND 
	mapel.semester_id = 2


) x ORDER BY x.order_1, x.order_2
