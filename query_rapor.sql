SELECT 
	d.*,
	(SELECT predikatpengetahuan.huruf FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = d.id  AND (d.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_huruf,
	(SELECT predikatpengetahuan.deskripsi FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = d.id  AND (d.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_deskripsi,

	(SELECT predikatketerampilan.huruf FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = d.id  AND (d.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_huruf,
	(SELECT predikatketerampilan.deskripsi FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = d.id  AND (d.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_deskripsi,

	(SELECT predikatsikap.huruf FROM predikatsikap WHERE  predikatsikap.mapel_id = d.id  AND (d.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_huruf,
	(SELECT predikatsikap.deskripsi FROM predikatsikap WHERE  predikatsikap.mapel_id = d.id  AND (d.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_deskripsi
FROM (
	SELECT 
		c.*,
		FORMAT(IF(c.pengetahuan_nilai_rapor_dayah < 70, (75/25), IF(c.pengetahuan_nilai_rapor_dayah < 75, (76/25), (c.pengetahuan_nilai_rapor_dayah/25) )), 2) AS pengetahuan_nilai_rapor_sekolah,
		FORMAT(IF(c.keterampilan_total_nilai < 70, (75/25), IF(c.keterampilan_total_nilai < 75, (76/25), (c.keterampilan_total_nilai/25) )), 2) AS keterampilan_nilai_rapor_sekolah
	FROM (
		SELECT 
			b.*,
			ROUND(
				((b.persentasepenilaian_pengetahuan_tnh / 100) * b.pengetahuan_tnh) +
				((b.persentasepenilaian_pengetahuan_nilai_uts / 100) * b.pengetahuan_nilai_uts) +
				((b.persentasepenilaian_pengetahuan_nilai_uas / 100) * b.pengetahuan_nilai_uas)
			) AS pengetahuan_nilai_rapor_dayah,
			ROUND(
				((b.persentasepenilaian_keterampilan_tnh / 100) * b.keterampilan_tnh) +
				((b.persentasepenilaian_keterampilan_projek / 100) * b.keterampilan_projek) + 
				((b.persentasepenilaian_keterampilan_porto / 100) * b.keterampilan_porto) +
				((b.persentasepenilaian_keterampilan_nilai_uts / 100) * b.keterampilan_nilai_uts) +
				((b.persentasepenilaian_keterampilan_nilai_uas / 100) * b.keterampilan_nilai_uas)
			) AS keterampilan_total_nilai,
			ROUND(
				((b.persentasepenilaian_sikap_tnh / 100) * b.sikap_tnh) +
				((b.persentasepenilaian_sikap_pd / 100) * b.sikap_pd) + 
				((b.persentasepenilaian_sikap_ps / 100) * b.sikap_ps) +
				((b.persentasepenilaian_sikap_jurnal / 100) * b.sikap_jurnal) +
				((b.persentasepenilaian_sikap_nilai_akhir / 100) * b.sikap_nilai_akhir)
			) AS sikap_nilai_rapor_sekolah
		FROM (
			SELECT 
				a.*,
				(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as pengetahuan_tnh,
				(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as pengetahuan_nilai_uts,
				(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as pengetahuan_nilai_uas,
				(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as keterampilan_tnh,
				(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as keterampilan_projek,
				(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as keterampilan_porto,
				(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as keterampilan_nilai_uts,
				(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as keterampilan_nilai_uas,
				(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as sikap_tnh,
				(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as sikap_pd,
				(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as sikap_ps,
				(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as sikap_jurnal,
				(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = 24 LIMIT 1) as sikap_nilai_akhir,
				
				(SELECT pengetahuan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_pengetahuan_tnh,
				(SELECT pengetahuan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_pengetahuan_nilai_uts,
				(SELECT pengetahuan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_pengetahuan_nilai_uas,
				(SELECT keterampilan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_keterampilan_tnh,
				(SELECT keterampilan_projek FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_keterampilan_projek,
				(SELECT keterampilan_porto FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_keterampilan_porto,
				(SELECT keterampilan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_keterampilan_nilai_uts,
				(SELECT keterampilan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_keterampilan_nilai_uas,
				(SELECT sikap_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_sikap_tnh,
				(SELECT sikap_pd FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_sikap_pd,
				(SELECT sikap_ps FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_sikap_ps,
				(SELECT sikap_jurnal FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_sikap_jurnal,
				(SELECT sikap_nilai_akhir FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = a.id) AS persentasepenilaian_sikap_nilai_akhir
				
			FROM (
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
				mapel.kelas_id = 5 AND 
				mapel.semester_id = 2


				

			) a
		) b
	) c
) d
WHERE kelompokmapel_id = 1
ORDER BY order_1, order_2 