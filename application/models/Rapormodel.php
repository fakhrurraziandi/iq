<?php 

class Rapormodel extends CI_Model{

	public function get_kelompokmapel($kelas_id){
		$query = $this->db->query("SELECT * FROM kelompokmapel WHERE kelompokmapel.kelas_id = {$kelas_id}");
		if($query->num_rows()){
			return $query->result();
		}else{
			return false;
		}
	}

	

	public function get_penilaian_rapor($penempatansiswa_id, $semester_id, $kelompokmapel_id){
		$sql = "SELECT 
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
										(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									) AS penilaian_id,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as pengetahuan_tnh,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as pengetahuan_nilai_uts,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as pengetahuan_nilai_uas,

									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as keterampilan_tnh,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as keterampilan_projek,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as keterampilan_porto,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as keterampilan_nilai_uts,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as keterampilan_nilai_uas,

									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as sikap_tnh,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as sikap_pd,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as sikap_ps,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
									)) as sikap_jurnal,
									ROUND(IF(
										y.is_gabungan,
										(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
										(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
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
										mapel.semester_id = {$semester_id} AND 
										mapel.kelompokmapel_id = {$kelompokmapel_id}

										UNION ALL

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
										0 AS has_child,
										mapel.parent_id AS order_1,
										mapel.id AS order_2
										FROM
										mapel
										INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
										INNER JOIN guru ON mapel.guru_id = guru.id
										WHERE 
										mapel.parent = 0 AND 
										mapel.semester_id = {$semester_id} AND 
										mapel.kelompokmapel_id = {$kelompokmapel_id}

									) x 
								) y  
							) z 
						) a 
					) b 
				) c ORDER BY c.order_1, c.order_2 ";



		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return [];
		}
	}

	public function get_total_nilai_rapor_uts($penempatansiswa_id, $semester_id){
		$sql = "SELECT 
					e.*,
					IF(e.nilai_rata_rata_skala_4 = 0, 'E', IF(e.nilai_rata_rata_skala_4 < 1, 'D', IF(e.nilai_rata_rata_skala_4 < 1.34, 'D+', IF(e.nilai_rata_rata_skala_4 < 1.68, 'C-', IF(e.nilai_rata_rata_skala_4 < 2.01, 'C', IF(e.nilai_rata_rata_skala_4 < 2.34, 'C+', IF(e.nilai_rata_rata_skala_4 < 2.68, 'B-', IF(e.nilai_rata_rata_skala_4 < 3.01, 'B', IF(e.nilai_rata_rata_skala_4 < 3.34, 'B+', IF(e.nilai_rata_rata_skala_4 < 3.68, 'A-', 'A') ) ) ) ) ) ) ) ) ) AS predikat_total 
				FROM (
					SELECT 
						ROUND(SUM(pengetahuan_nilai_uts), 2) AS total_nilai_skala_100,
						ROUND(SUM(pengetahuan_nilai_uts / 25), 2) AS total_nilai_skala_4,
						ROUND(AVG(pengetahuan_nilai_uts), 2) AS nilai_rata_rata_skala_100,
						ROUND(AVG(pengetahuan_nilai_uts / 25), 2) AS nilai_rata_rata_skala_4
					FROM (
						SELECT 
							c.*,
							(SELECT predikatpengetahuan.huruf FROM predikatpengetahuan WHERE predikatpengetahuan.mapel_id = c.id AND (c.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_huruf,
							(SELECT predikatpengetahuan.deskripsi FROM predikatpengetahuan WHERE predikatpengetahuan.mapel_id = c.id AND (c.pengetahuan_nilai_rapor_sekolah <= predikatpengetahuan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatpengetahuan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS pengetahuan_predikat_deskripsi,

							(SELECT predikatketerampilan.huruf FROM predikatketerampilan WHERE predikatketerampilan.mapel_id = c.id AND (c.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_huruf,
							(SELECT predikatketerampilan.deskripsi FROM predikatketerampilan WHERE predikatketerampilan.mapel_id = c.id AND (c.keterampilan_nilai_rapor_sekolah <= predikatketerampilan.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatketerampilan.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS keterampilan_predikat_deskripsi,

							(SELECT predikatsikap.huruf FROM predikatsikap WHERE predikatsikap.mapel_id = c.id AND (c.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_huruf,
							(SELECT predikatsikap.deskripsi FROM predikatsikap WHERE predikatsikap.mapel_id = c.id AND (c.sikap_nilai_rapor_sekolah <= predikatsikap.lebih_kecil_atau_sama_dengan) = 1 ORDER BY predikatsikap.lebih_kecil_atau_sama_dengan ASC LIMIT 1) AS sikap_predikat_deskripsi

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
												(SELECT penilaian.id FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
											) AS penilaian_id,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as pengetahuan_tnh,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as pengetahuan_nilai_uts,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as pengetahuan_nilai_uas,

											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as keterampilan_tnh,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as keterampilan_projek,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as keterampilan_porto,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as keterampilan_nilai_uts,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as keterampilan_nilai_uas,

											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as sikap_tnh,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as sikap_pd,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as sikap_ps,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
											)) as sikap_jurnal,
											ROUND(IF(
												y.is_gabungan,
												IFNULL((SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = y.id) AND penilaiandayah.penempatansiswa_id = 1), 0),
												IFNULL((SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = y.id AND penilaian.penempatansiswa_id = 1 LIMIT 1), 0)
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
												mapel.semester_id = {$semester_id}

												UNION ALL

												SELECT
												mapel.id,
												concat('          ', mapel.mapel) as mapel,
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
												mapel.semester_id = {$semester_id}
											) x 
										) y  
									) z 
								) a 
							) b 
						) c 
					) d 
					WHERE d.has_child = 0
				) e ";

		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result()[0];
		}else{
			return false;
		}
	}

	

	public function get_rekapabsen($penempatansiswa_id, $semester_id){
		$sql = "SELECT
					rekapabsen.id,
					rekapabsen.penempatansiswa_id,
					rekapabsen.semester_id,
					rekapabsen.sakit,
					rekapabsen.izin,
					rekapabsen.alpha,
					rekapabsen.hadir
				FROM
					rekapabsen
				WHERE penempatansiswa_id = {$penempatansiswa_id} AND semester_id = {$semester_id} ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->row();
		}else{
			return [];
		}
	}

	public function get_penilaianextrakurikuler($penempatansiswa_id, $semester_id){
		

		$sql = "SELECT
					penilaianextrakurikuler.id,
					penilaianextrakurikuler.penempatansiswa_id,
					penilaianextrakurikuler.extrakurikuler_id,
					penilaianextrakurikuler.predikat,
					penilaianextrakurikuler.keterangan,
					penilaianextrakurikuler.semester_id,
					extrakurikuler.id,
					extrakurikuler.extrakurikuler,
					extrakurikuler.tahunajaran_id,
					extrakurikuler.tingkat_id
				FROM
					penilaianextrakurikuler
				INNER JOIN extrakurikuler ON penilaianextrakurikuler.extrakurikuler_id = extrakurikuler.id
				WHERE penilaianextrakurikuler.penempatansiswa_id = {$penempatansiswa_id} AND penilaianextrakurikuler.semester_id = {$semester_id} ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result();
		}else{
			return false;
		}
	}

	public function get_kepribadian($penempatansiswa_id, $semester_id, $kelas_id){
		$sql = "SELECT x.* FROM (
					SELECT
						penempatansiswa.id,
						penempatansiswa.kelas_id,
						penempatansiswa.siswa_id,
						siswa.nisn,
						siswa.nis_lokal,
						siswa.nama,
						siswa.jenis_kelamin,
						(SELECT kepribadian.id FROM kepribadian WHERE kepribadian.penempatansiswa_id = penempatansiswa.id AND kepribadian.semester_id = {$semester_id}) AS kepribadian_id,
						(SELECT kepribadian.kelakuan FROM kepribadian WHERE kepribadian.penempatansiswa_id = penempatansiswa.id AND kepribadian.semester_id = {$semester_id}) AS kelakuan,
						(SELECT kepribadian.kedisiplinan FROM kepribadian WHERE kepribadian.penempatansiswa_id = penempatansiswa.id AND kepribadian.semester_id = {$semester_id}) AS kedisiplinan,
						(SELECT kepribadian.kerapian FROM kepribadian WHERE kepribadian.penempatansiswa_id = penempatansiswa.id AND kepribadian.semester_id = {$semester_id}) AS kerapian
						
					FROM
						penempatansiswa
					INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
					INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
					WHERE penempatansiswa.kelas_id = {$kelas_id}
				) x WHERE x.id = {$penempatansiswa_id} ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->row();
		}else{
			return [];
		}
	}

	/*public function get_mapel($kelas_id, $semester_id, $kelompokmapel_id){

		$query = $this->db->query("SELECT * FROM (
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
                                              mapel.kelas_id = {$kelas_id} AND
                                              mapel.semester_id = {$semester_id}
                            
                            
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
                                              mapel.kelas_id = {$kelas_id} AND
                                              mapel.semester_id = {$semester_id}
                            
                                          ) x
                            	WHERE x.kelompokmapel_id = {$kelompokmapel_id}
                            ORDER BY x.order_1, x.order_2 ");
		if($query->num_rows()){
			return $query->result();
		}else{
			return false;
		}
	}*/


	public function get_mapel_parent($kelas_id, $semester_id, $penempatansiswa_id, $kelompokmapel_id){

		

		$sql = "SELECT 
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
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_nilai_uts,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_nilai_uas,

								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_projek,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_porto,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_nilai_uts,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_nilai_uas,

								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_pd,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_ps,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_jurnal,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_nilai_akhir,
								# (SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_tnh,
								# (SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uts,
								# (SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uas,
								# (SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_tnh,
								# (SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_projek,
								# (SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_porto,
								# (SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uts,
								# (SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uas,
								# (SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_tnh,
								# (SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_pd,
								# (SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_ps,
								# (SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_jurnal,
								# (SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_nilai_akhir,
								
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
								mapel.kkm,
								kelompokmapel.kelompokmapel,
								kelompokmapel.semester_id,
								guru.nama AS guru,
								(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child,
								(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = mapel.id) AS is_gabungan,
								mapel.id AS order_1,
								mapel.id AS order_2
								FROM
								mapel
								INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
								INNER JOIN guru ON mapel.guru_id = guru.id
								WHERE 
								mapel.parent = 1 AND 
								mapel.kelas_id = {$kelas_id} AND 
								mapel.semester_id = {$semester_id}
							) a
						) b
					) c
				) d
				WHERE kelompokmapel_id = {$kelompokmapel_id}
				ORDER BY order_1, order_2 ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result();
		}

		return [];
	}

	public function get_mapel_child($kelas_id, $semester_id, $penempatansiswa_id, $kelompokmapel_id, $parent_id){

		$sql = "SELECT 
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
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_nilai_uts,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS pengetahuan_nilai_uas,

								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_projek) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_projek,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_porto) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_porto,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_nilai_uts,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.keterampilan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS keterampilan_nilai_uas,

								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_tnh,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_pd) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_pd,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_ps) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_ps,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_jurnal) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_jurnal,
								ROUND(IF(
									a.is_gabungan,
									(SELECT AVG(penilaiandayah.sikap_nilai_akhir) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = a.id) AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id}),
									(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1)
								), 2) AS sikap_nilai_akhir,
								# (SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_tnh,
								# (SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uts,
								# (SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uas,
								# (SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_tnh,
								# (SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_projek,
								# (SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_porto,
								# (SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uts,
								# (SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uas,
								# (SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_tnh,
								# (SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_pd,
								# (SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_ps,
								# (SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_jurnal,
								# (SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_nilai_akhir,
								
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
								mapel.kkm,
								kelompokmapel.kelompokmapel,
								kelompokmapel.semester_id,
								guru.nama AS guru,
								0 AS has_child,
								(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = mapel.id) AS is_gabungan,
								mapel.parent_id AS order_1,
								mapel.id AS order_2
								FROM
								mapel
								INNER JOIN kelompokmapel ON mapel.kelompokmapel_id = kelompokmapel.id
								INNER JOIN guru ON mapel.guru_id = guru.id
								WHERE 
								mapel.parent = 0 AND 
								mapel.kelas_id = {$kelas_id} AND 
								mapel.semester_id = {$semester_id} AND
								mapel.parent_id = {$parent_id}
							) a
						) b
					) c
				) d
				WHERE kelompokmapel_id = {$kelompokmapel_id}
				ORDER BY order_1, order_2 ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result();
		}

		return [];
	}

	public function get_mapel($kelas_id, $semester_id, $penempatansiswa_id, $kelompokmapel_id){

		$sql = "SELECT 
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
								(SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_tnh,
								(SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uts,
								(SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uas,
								(SELECT penilaian.keterampilan_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_tnh,
								(SELECT penilaian.keterampilan_projek FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_projek,
								(SELECT penilaian.keterampilan_porto FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_porto,
								(SELECT penilaian.keterampilan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uts,
								(SELECT penilaian.keterampilan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as keterampilan_nilai_uas,
								(SELECT penilaian.sikap_tnh FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_tnh,
								(SELECT penilaian.sikap_pd FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_pd,
								(SELECT penilaian.sikap_ps FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_ps,
								(SELECT penilaian.sikap_jurnal FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_jurnal,
								(SELECT penilaian.sikap_nilai_akhir FROM penilaian WHERE penilaian.mapel_id = a.id AND penilaian.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as sikap_nilai_akhir,
								
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
								mapel.kelas_id = {$kelas_id} AND 
								mapel.semester_id = {$semester_id} 


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
								mapel.kelas_id = {$kelas_id} AND 
								mapel.semester_id = {$semester_id}

							) a
						) b
					) c
				) d
				WHERE kelompokmapel_id = $kelompokmapel_id
				ORDER BY order_1, order_2 ";
		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result();
		}else{
			return false;
		}
	}

	public function get_ledger_uts_siswa($kelas_id, $semester_id, $penempatansiswa_id){
		$ledger_uts = $this->get_ledger_uts($kelas_id, $semester_id);

		for($i = 0; $i < count($ledger_uts); $i++){
			if($ledger_uts[$i]->id == $penempatansiswa_id){
				return $ledger_uts[$i];
			}
		}

		return false;
	}

	public function get_ledger_uts($kelas_id, $semester_id){

		$sql = "SELECT 
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
						mapel.kelas_id = {$kelas_id} AND 
						mapel.semester_id = {$semester_id} 

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
						mapel.kelas_id = {$kelas_id}  AND 
						mapel.semester_id = {$semester_id} 

				) x 
				WHERE x.has_child = 0
				ORDER BY x.order_1, x.order_2 ";



		$query = $this->db->query($sql);

		

		if($query->num_rows() > 0){

			$mapel_count = $query->num_rows();
			$array_select_mapel_id = [];
			$array_select_nilai_uts = [];

			foreach($query->result() as $mapel){

				$array_select_mapel_id[]  = "b.`{$mapel->id}`";
				$array_select_nilai_uts[] = "ROUND(
												IF(
													(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}),
													IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
													IFNULL((SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel->id} AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
												)
											) as `{$mapel->id}`";
			}

			$select_mapel_id  = implode(' + ', $array_select_mapel_id);
			$select_nilai_uts = implode(' , ', $array_select_nilai_uts);
			// IF(d.nilai_rata_rata_skala_4 = 0, 'E', IF(d.nilai_rata_rata_skala_4 < 1, 'D', IF(d.nilai_rata_rata_skala_4 < 1.34, 'D+', IF(d.nilai_rata_rata_skala_4 < 1.68, 'C-', IF(d.nilai_rata_rata_skala_4 < 2.01, 'C', IF(d.nilai_rata_rata_skala_4 < 2.34, 'C+', IF(d.nilai_rata_rata_skala_4 < 2.68, 'B-', IF(d.nilai_rata_rata_skala_4 < 3.01, 'B', IF(d.nilai_rata_rata_skala_4 < 3.34, 'B+', IF(d.nilai_rata_rata_skala_4 < 3.68, 'A-', 'A') ) ) ) ) ) ) ) ) ) AS predikat_total 
			$sql = "SELECT 
						d.*,
						IF(d.nilai_rata_rata_skala_4 = 0, 'E', IF(d.nilai_rata_rata_skala_4 < 1, 'D', IF(d.nilai_rata_rata_skala_4 < 1.34, 'D+', IF(d.nilai_rata_rata_skala_4 < 1.68, 'C-', IF(d.nilai_rata_rata_skala_4 < 2.01, 'C', IF(d.nilai_rata_rata_skala_4 < 2.34, 'C+', IF(d.nilai_rata_rata_skala_4 < 2.68, 'B-', IF(d.nilai_rata_rata_skala_4 < 3.01, 'B', IF(d.nilai_rata_rata_skala_4 < 3.34, 'B+', IF(d.nilai_rata_rata_skala_4 < 3.68, 'A-', 'A') ) ) ) ) ) ) ) ) ) AS predikat_total 
					FROM (
						SELECT 
							c.*,
							ROUND((c.total_nilai_skala_100 / 25), 2) as total_nilai_skala_4,
							ROUND((c.nilai_rata_rata_skala_100 / 25), 2) as nilai_rata_rata_skala_4
						FROM (
							SELECT 
								b.*,
								ROUND(({$select_mapel_id}), 2) AS total_nilai_skala_100,
								ROUND((({$select_mapel_id}) / {$mapel_count}), 2) AS nilai_rata_rata_skala_100
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
										$select_nilai_uts
									FROM
										penempatansiswa
									INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
									INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
									WHERE penempatansiswa.kelas_id = {$kelas_id}
								) a  
							) b
						) c 
					) d ORDER BY d.total_nilai_skala_100 DESC, d.nama ASC ";

			echo $sql;

			$query = $this->db->query($sql);
			if($query->num_rows()){
				$result = $query->result();
				for($i = 0; $i < count($result); $i++){
					$result[$i]->ranking = $i + 1;
					$result[$i]->dari = count($result);
				}

				return $result;
			}
		}
	}

	public function get_ledger_uas_siswa($kelas_id, $semester_id, $penempatansiswa_id){

		$ledger_uas = $this->get_ledger_uas($kelas_id, $semester_id);

		for($i = 0; $i < count($ledger_uas); $i++){
			
			if($ledger_uas[$i]->id == $penempatansiswa_id){
				return $ledger_uas[$i];
			}
		}

		return false;
	}

	public function get_ledger_uas($kelas_id, $semester_id){

		$sql = "SELECT 
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
						mapel.kelas_id = {$kelas_id} AND 
						mapel.semester_id = {$semester_id} 

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
						mapel.kelas_id = {$kelas_id}  AND 
						mapel.semester_id = {$semester_id} 

				) x 
				WHERE x.has_child = 0
				ORDER BY x.order_1, x.order_2 ";



		$query = $this->db->query($sql);

		

		if($query->num_rows() > 0){

			$mapel_count                                        = $query->num_rows();
			$array_select_mapel_pengetahuan_nilai_rapor_sekolah = [];
			$array_select_nilai                                 = [];
			$array_select_persentasepenilaian_uts               = [];
			$array_select_nilai_rapor_dayah                     = [];

			foreach($query->result() as $mapel){

				$array_select_mapel_pengetahuan_nilai_rapor_sekolah[]  = "b.`{$mapel->id}_pengetahuan_nilai_rapor_sekolah`";
				$array_select_nilai[] = "ROUND(
												IF(
													(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}),
													IFNULL((SELECT AVG(penilaiandayah.pengetahuan_tnh) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
													IFNULL((SELECT penilaian.pengetahuan_tnh FROM penilaian WHERE penilaian.mapel_id = {$mapel->id} AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
												)
											) as {$mapel->id}_pengetahuan_tnh,
											ROUND(
												IF(
													(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}),
													IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uts) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
													IFNULL((SELECT penilaian.pengetahuan_nilai_uts FROM penilaian WHERE penilaian.mapel_id = {$mapel->id} AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
												)
											) as {$mapel->id}_pengetahuan_nilai_uts,
											ROUND(
												IF(
													(SELECT COUNT(*) FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}),
													IFNULL((SELECT AVG(penilaiandayah.pengetahuan_nilai_uas) FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id IN (SELECT mapelgabungan.mapeldayah_id FROM mapelgabungan WHERE mapelgabungan.mapel_id = {$mapel->id}) AND penilaiandayah.penempatansiswa_id = penempatansiswa.id), 0),
													IFNULL((SELECT penilaian.pengetahuan_nilai_uas FROM penilaian WHERE penilaian.mapel_id = {$mapel->id} AND penilaian.penempatansiswa_id = penempatansiswa.id LIMIT 1), 0)
												)
											) as {$mapel->id}_pengetahuan_nilai_uas";

				$array_select_persentasepenilaian[] = "(SELECT pengetahuan_tnh FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = {$mapel->id}) AS {$mapel->id}_persentasepenilaian_pengetahuan_tnh,
															(SELECT pengetahuan_nilai_uts FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = {$mapel->id}) AS {$mapel->id}_persentasepenilaian_pengetahuan_nilai_uts,
															(SELECT pengetahuan_nilai_uas FROM persentasepenilaian WHERE persentasepenilaian.mapel_id = {$mapel->id}) AS {$mapel->id}_persentasepenilaian_pengetahuan_nilai_uas";

				$array_select_nilai_rapor_dayah[] = "ROUND(
														(({$mapel->id}_persentasepenilaian_pengetahuan_tnh / 100) * {$mapel->id}_pengetahuan_tnh) +
														(({$mapel->id}_persentasepenilaian_pengetahuan_nilai_uts / 100) * {$mapel->id}_pengetahuan_nilai_uts) +
														(({$mapel->id}_persentasepenilaian_pengetahuan_nilai_uas / 100) * {$mapel->id}_pengetahuan_nilai_uas)
													) AS {$mapel->id}_pengetahuan_nilai_rapor_dayah ";

				$array_select_nilai_rapor_sekolah[] = "COALESCE(FORMAT(IF(z.{$mapel->id}_pengetahuan_nilai_rapor_dayah < 70, (75/25), IF(z.{$mapel->id}_pengetahuan_nilai_rapor_dayah < 75, (76/25), (z.{$mapel->id}_pengetahuan_nilai_rapor_dayah/25) )), 2), 0) AS {$mapel->id}_pengetahuan_nilai_rapor_sekolah";
			}

			$select_mapel_pengetahuan_nilai_rapor_sekolah = implode(' + ', $array_select_mapel_pengetahuan_nilai_rapor_sekolah);
			$select_nilai                                 = implode(' , ', $array_select_nilai);
			$select_persentasepenilaian                   = implode(' , ', $array_select_persentasepenilaian);
			$select_nilai_rapor_dayah                     = implode(' , ', $array_select_nilai_rapor_dayah);
			$select_nilai_rapor_sekolah                   = implode(' , ', $array_select_nilai_rapor_sekolah);
			
			$sql = "SELECT 
						c.* 
					FROM (
						SELECT 
							b.*,
							ROUND(({$select_mapel_pengetahuan_nilai_rapor_sekolah}), 2) AS total_nilai,
							ROUND((({$select_mapel_pengetahuan_nilai_rapor_sekolah}) / {$mapel_count}), 2) AS nilai_rata_rata
						FROM (
							SELECT
								a.*
							FROM (
								SELECT 
									z.*,
									{$select_nilai_rapor_sekolah}
								FROM (
									SELECT 
										y.* ,
										{$select_nilai_rapor_dayah}
									FROM (
										SELECT 
											x.*,
											{$select_persentasepenilaian}
										FROM (
											SELECT
												penempatansiswa.id,
												penempatansiswa.kelas_id,
												penempatansiswa.siswa_id,
												siswa.nisn,
												siswa.nis_lokal,
												siswa.nama,
												$select_nilai
											FROM
												penempatansiswa
											INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
											INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
											WHERE penempatansiswa.kelas_id = {$kelas_id}
										) x
									) y
								) z
							) a  
						) b
					) c ORDER BY c.total_nilai DESC, c.nama ASC ";

			

			$query = $this->db->query($sql);
			if($query->num_rows()){
				$result = $query->result();
				for($i = 0; $i < count($result); $i++){
					$result[$i]->ranking = $i + 1;
					$result[$i]->dari = count($result);
				}

				return $result;
			}
		}
	}


	
}