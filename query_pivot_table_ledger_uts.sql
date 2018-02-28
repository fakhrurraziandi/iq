SET SESSION group_concat_max_len = 10000;



SET @sql_dynamic = (
	SELECT 
		GROUP_CONCAT(
			CONCAT('b.`', y.id, '`') SEPARATOR ' + '
		) 
	FROM (
		SELECT 
			x.*,
			(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = x.id) as is_gabungan
		FROM (
			SELECT
				mapel.id,
				mapel.mapel,
				(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
				mapel.id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 1 AND 
				mapel.kelas_id = 3 AND 
				mapel.semester_id = 2

			UNION ALL

			SELECT
				mapel.id,
				CONCAT('     ', mapel.mapel),
				0 AS has_child,
				mapel.parent_id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 0 AND 
				mapel.kelas_id = 3  AND 
				mapel.semester_id = 2

		) x 
		WHERE x.has_child = 0
		ORDER BY x.order_1, x.order_2
	) y 
);


SET @sql_dynamic_2 = (
	SELECT 
		GROUP_CONCAT(
			CONCAT(
				'ROUND(
					IF(
						(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = ', y.id, '), 
						IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = ', y.id, ') AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
						IFNULL((SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = ', y.id, ' AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
					)
				)	AS `', y.id ,'`'
			) SEPARATOR ', '
		) 
	FROM (
		SELECT 
			x.*,
			(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = x.id) as is_gabungan
		FROM (
			SELECT
				mapel.id,
				mapel.mapel,
				(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
				mapel.id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 1 AND 
				mapel.kelas_id = 3 AND 
				mapel.semester_id = 2

			UNION ALL

			SELECT
				mapel.id,
				CONCAT('     ', mapel.mapel),
				0 AS has_child,
				mapel.parent_id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 0 AND 
				mapel.kelas_id = 3  AND 
				mapel.semester_id = 2

		) x 
		WHERE x.has_child = 0
		ORDER BY x.order_1, x.order_2
	) y 
);

SET @mapel_count = (
	SELECT 
		COUNT(*) AS mapel_count
	FROM (
		SELECT 
			x.*,
			(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = x.id) as is_gabungan
		FROM (
			SELECT
				mapel.id,
				mapel.mapel,
				(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
				mapel.id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 1 AND 
				mapel.kelas_id = 3 AND 
				mapel.semester_id = 2

			UNION ALL

			SELECT
				mapel.id,
				CONCAT('     ', mapel.mapel),
				0 AS has_child,
				mapel.parent_id AS order_1,
				mapel.id AS order_2
			FROM
				mapel
			WHERE 
				mapel.parent = 0 AND 
				mapel.kelas_id = 3  AND 
				mapel.semester_id = 2

		) x 
		WHERE x.has_child = 0
	) y
);


SET @sql = CONCAT(
	'SELECT 
		c.*,
		ROUND((c.total_nilai_skala_100 / 25), 2) as total_nilai_skala_4,
		ROUND((c.nilai_rata_rata_skala_100 / 25), 2) as nilai_rata_rata_skala_4 
	FROM (
			SELECT 
				b.*,
				ROUND((', @sql_dynamic , '), 2) AS total_nilai_skala_100,
				ROUND(((', @sql_dynamic , ') / ', @mapel_count ,'), 2) AS nilai_rata_rata_skala_100 
			FROM (
				SELECT
					*
				FROM (
					SELECT
						penempatansiswa.id,
						penempatansiswa.kelas_id,
						penempatansiswa.siswa_id,
						siswa.nisn,
						siswa.nis_lokal,
						siswa.nama,
						',@sql_dynamic_2 ,' 
					FROM
						penempatansiswa
					INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
					INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
					WHERE penempatansiswa.kelas_id = 3
				) a  
			) b
		) c '
);

PREPARE stmt FROM @sql;
EXECUTE stmt;
DEALLOCATE PREPARE stmt;