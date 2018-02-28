SELECT 
	c.*,
	(SELECT predikatpengetahuan.huruf FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = c.id  AND (c.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_huruf,
	(SELECT predikatpengetahuan.deskripsi FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = c.id  AND (c.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_deskripsi,

	(SELECT predikatketerampilan.huruf FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = c.id  AND (c.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_huruf,
	(SELECT predikatketerampilan.deskripsi FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = c.id  AND (c.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_deskripsi,

	(SELECT predikatsikap.huruf FROM predikatsikap WHERE  predikatsikap.mapel_id = c.id  AND (c.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_huruf,
	(SELECT predikatsikap.deskripsi FROM predikatsikap WHERE  predikatsikap.mapel_id = c.id  AND (c.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_deskripsi

FROM (
	SELECT 
		b.*,
		FORMAT(IF(b.pengetahuan_nilai_rapor_dayah < 70, (75/25), IF(b.pengetahuan_nilai_rapor_dayah < 75, (76/25), (b.pengetahuan_nilai_rapor_dayah/25) )), 2) AS pengetahuan_nilai_rapor_sekolah,
		FORMAT(IF(b.keterampilan_total_nilai < 70, (75/25), IF(b.keterampilan_total_nilai < 75, (76/25), (b.keterampilan_total_nilai/25) )), 2) AS keterampilan_nilai_rapor_sekolah
	FROM (
		SELECT 
			a.*,
			ROUND(
				((a.persentasepenilaian_pengetahuan_tnh / 100) * a.pengetahuan_tnh) +
				((a.persentasepenilaian_pengetahuan_nilai_uts / 100) * a.pengetahuan_nilai_uts) +
				((a.persentasepenilaian_pengetahuan_nilai_uas / 100) * a.pengetahuan_nilai_uas)
			) AS pengetahuan_nilai_rapor_dayah,
			ROUND(
				((a.persentasepenilaian_keterampilan_tnh / 100) * a.keterampilan_tnh) +
				((a.persentasepenilaian_keterampilan_projek / 100) * a.keterampilan_projek) +
				((a.persentasepenilaian_keterampilan_porto / 100) * a.keterampilan_porto) +
				((a.persentasepenilaian_keterampilan_nilai_uts / 100) * a.keterampilan_nilai_uts) +
				((a.persentasepenilaian_keterampilan_nilai_uas / 100) * a.keterampilan_nilai_uas)
			) AS keterampilan_total_nilai,
			ROUND(
				((a.persentasepenilaian_sikap_tnh / 100) * a.sikap_tnh) +
				((a.persentasepenilaian_sikap_pd / 100) * a.sikap_pd) +
				((a.persentasepenilaian_sikap_ps / 100) * a.sikap_ps) +
				((a.persentasepenilaian_sikap_jurnal / 100) * a.sikap_jurnal) +
				((a.persentasepenilaian_sikap_nilai_akhir / 100) * a.sikap_nilai_akhir)
			) AS sikap_nilai_rapor_sekolah
		FROM (
			SELECT 
				z.*,
				(SELECT pengetahuan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_pengetahuan_tnh,
				(SELECT pengetahuan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_pengetahuan_nilai_uts,
				(SELECT pengetahuan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_pengetahuan_nilai_uas,

				(SELECT keterampilan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_keterampilan_tnh,
				(SELECT keterampilan_projek FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_keterampilan_projek,
				(SELECT keterampilan_porto FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_keterampilan_porto,
				(SELECT keterampilan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_keterampilan_nilai_uts,
				(SELECT keterampilan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_keterampilan_nilai_uas,

				(SELECT sikap_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_sikap_tnh,
				(SELECT sikap_pd FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_sikap_pd,
				(SELECT sikap_ps FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_sikap_ps,
				(SELECT sikap_jurnal FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_sikap_jurnal,
				(SELECT sikap_nilai_akhir FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.id) AS persentasepenilaian_sikap_nilai_akhir
			FROM (
				SELECT 
					y.*,
					IF(
						y.is_gabungan,
						null,
						(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					) AS penilaian_id,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as pengetahuan_tnh,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as pengetahuan_nilai_uts,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as pengetahuan_nilai_uas,

					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as keterampilan_tnh,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as keterampilan_projek,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as keterampilan_porto,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as keterampilan_nilai_uts,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as keterampilan_nilai_uas,

					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as sikap_tnh,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as sikap_pd,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as sikap_ps,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as sikap_jurnal,
					ROUND(IF(
						y.is_gabungan,
						(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1),
						(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1)
					)) as sikap_nilai_akhir
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
				) y  
			) z 
		) a 
	) b 
) c ORDER BY c.order_1, c.order_2 