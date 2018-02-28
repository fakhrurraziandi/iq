SELECT 
	y.*,
	IF(
		y.is_gabungan,
		null,
		(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
	) AS penilaian_id,
	ROUND(IF(
		y.is_gabungan,
		(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
		(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
	)) as pengetahuan_nilai_uts
FROM (
	SELECT 
		x.*,
		(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = x.id) as is_gabungan
	FROM (
		SELECT
		mapel.id,
		mapel.mapel,
		mapel.kelas_id,
		mapel.guru_id,
		mapel.kelompokmapel_id,
		mapel.kkm,
		mapel.parent,
		mapel.parent_id,
		kelompokmapel.kelompokmapel,
		kelompokmapel.semester_id,
		guru.nama AS guru,
		(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
		mapel.id AS order_1,
		mapel.id AS order_2
		FROM
		mapel
		INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
		INNER JOIN guru ON mapel.guru_id = guru.id
		WHERE 
		mapel.parent = 1 AND 
		mapel.kelas_id = 3 AND 
		mapel.semester_id = 2 AND
		mapel.kelompokmapel_id = 1

		UNION ALL

		SELECT
		mapel.id,
		CONCAT('     ', mapel.mapel),
		mapel.kelas_id,
		mapel.guru_id,
		mapel.kelompokmapel_id,
		mapel.kkm,
		mapel.parent,
		mapel.parent_id,
		kelompokmapel.kelompokmapel,
		kelompokmapel.semester_id,
		guru.nama AS guru,
		0 AS has_child,
		mapel.parent_id AS order_1,
		mapel.id AS order_2
		FROM
		mapel
		INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
		INNER JOIN guru ON mapel.guru_id = guru.id
		WHERE 
		mapel.parent = 0 AND 
		mapel.kelas_id = 3  AND 
		mapel.semester_id = 2

	) x 
	WHERE x.has_child = 0
	
) y
ORDER BY y.order_1, y.order_2 