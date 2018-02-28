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
		siswa.jenis_kelamin
	FROM
		penempatansiswa
	INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
	INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
	WHERE penempatansiswa.kelas_id = 3
) x 