SELECT
	x.*,
	(SELECT predikatpengetahuan.huruf FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = {$mapel_id}  AND (x.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_huruf,
	(SELECT predikatpengetahuan.deskripsi FROM predikatpengetahuan WHERE  predikatpengetahuan.mapel_id = {$mapel_id}  AND (x.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_deskripsi,

	(SELECT predikatketerampilan.huruf FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = {$mapel_id}  AND (x.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_huruf,
	(SELECT predikatketerampilan.deskripsi FROM predikatketerampilan WHERE  predikatketerampilan.mapel_id = {$mapel_id}  AND (x.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_deskripsi,

	(SELECT predikatsikap.huruf FROM predikatsikap WHERE  predikatsikap.mapel_id = {$mapel_id}  AND (x.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_huruf,
	(SELECT predikatsikap.deskripsi FROM predikatsikap WHERE  predikatsikap.mapel_id = {$mapel_id}  AND (x.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_deskripsi
FROM
	(
		SELECT
			i.*,
			FORMAT(IF(i.pengetahuan_nilai_rapor_dayah < 70, (75/25), IF(i.pengetahuan_nilai_rapor_dayah < 75, (76/25), (i.pengetahuan_nilai_rapor_dayah/25) )), 2) AS pengetahuan_nilai_rapor_sekolah,
			FORMAT(IF(i.keterampilan_total_nilai < 70, (75/25), IF(i.keterampilan_total_nilai < 75, (76/25), (i.keterampilan_total_nilai/25) )), 2) AS keterampilan_nilai_rapor_sekolah
		FROM (
			SELECT
				y.*,
				ROUND(
					((persentasepenilaian_pengetahuan_tnh / 100) * pengetahuan_tnh) +
					((persentasepenilaian_pengetahuan_nilai_uts / 100) * pengetahuan_nilai_uts) +
					((persentasepenilaian_pengetahuan_nilai_uas / 100) * pengetahuan_nilai_uas)
				) AS pengetahuan_nilai_rapor_dayah,
				ROUND(
					((persentasepenilaian_keterampilan_tnh / 100) * keterampilan_tnh) +
					((persentasepenilaian_keterampilan_projek / 100) * keterampilan_projek) +
					((persentasepenilaian_keterampilan_porto / 100) * keterampilan_porto) +
					((persentasepenilaian_keterampilan_nilai_uts / 100) * keterampilan_nilai_uts) +
					((persentasepenilaian_keterampilan_nilai_uas / 100) * keterampilan_nilai_uas)
				) AS keterampilan_total_nilai,
				ROUND(
					((persentasepenilaian_sikap_tnh / 100) * sikap_tnh) +
					((persentasepenilaian_sikap_pd / 100) * sikap_pd) +
					((persentasepenilaian_sikap_ps / 100) * sikap_ps) +
					((persentasepenilaian_sikap_jurnal / 100) * sikap_jurnal) +
					((persentasepenilaian_sikap_nilai_akhir / 100) * sikap_nilai_akhir)
				) AS sikap_nilai_rapor_sekolah
			FROM (
				SELECT
					z.*,
					(SELECT pengetahuan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_tnh,
					(SELECT pengetahuan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_nilai_uts,
					(SELECT pengetahuan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_pengetahuan_nilai_uas,

					(SELECT keterampilan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_tnh,
					(SELECT keterampilan_projek FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_projek,
					(SELECT keterampilan_porto FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_porto,
					(SELECT keterampilan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_nilai_uts,
					(SELECT keterampilan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_keterampilan_nilai_uas,

					(SELECT sikap_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_tnh,
					(SELECT sikap_pd FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_pd,
					(SELECT sikap_ps FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_ps,
					(SELECT sikap_jurnal FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_jurnal,
					(SELECT sikap_nilai_akhir FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = z.mapel_id) AS persentasepenilaian_sikap_nilai_akhir


				FROM (
					SELECT
						j.*,
						IF(
							j.is_gabungan,
							null,
							(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						) AS penilaian_id,

						# (SELECT penilaian.mapel_id FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1) AS mapel_id,
						{$mapel_id} AS mapel_id,

						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as pengetahuan_tnh,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as pengetahuan_nilai_uts,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as pengetahuan_nilai_uas,

						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as keterampilan_tnh,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as keterampilan_projek,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as keterampilan_porto,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as keterampilan_nilai_uts,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as keterampilan_nilai_uas,

						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as sikap_tnh,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as sikap_pd,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as sikap_ps,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as sikap_jurnal,
						ROUND(IF(
							j.is_gabungan,
							(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AND penilaiandayah.penempatansiswa_id = j.id),
							(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = {$mapel_id} AND penilaian.penempatansiswa_id = j.id LIMIT 1)
						)) as sikap_nilai_akhir

					FROM (
						SELECT
							penempatansiswa.id,
							penempatansiswa.kelas_id,
							penempatansiswa.siswa_id,
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin,
							(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel_id}) AS is_gabungan
						FROM
							penempatansiswa
						INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
						INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
						WHERE penempatansiswa.kelas_id = {$kelas_id}
					) j
				) z
			) y
							) i
						) x 