SELECT
	a.*
FROM (
	SELECT
		penempatansiswa.id,
		penempatansiswa.kelas_id,
		penempatansiswa.siswa_id,
		siswa.nisn,
		siswa.nis_lokal,
		siswa.nama,
		ROUND(
			IF(
				(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2),
				IFNULL((SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
				IFNULL((SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = 2 AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
			)
		) as 2_pengetahuan_tnh,
		ROUND(
			IF(
				(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2),
				IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
				IFNULL((SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = 2 AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
			)
		) as 2_pengetahuan_nilai_uts,
		ROUND(
			IF(
				(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2),
				IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = 2) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
				IFNULL((SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = 2 AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
			)
		) as 2_pengetahuan_nilai_uas

	FROM
		penempatansiswa
	INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
	INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
	WHERE penempatansiswa.kelas_id = 3
) a