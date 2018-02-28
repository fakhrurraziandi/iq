<?php 

class Rapordayahmodel extends CI_Model{
	public function get_mapel($kelas_id, $semester_id, $penempatansiswa_id){
		$sql = "SELECT 
					b.*,
					ROUND(
						((b.persentasepenilaian_pengetahuan_tnh / 100) * b.pengetahuan_tnh) +
						((b.persentasepenilaian_pengetahuan_nilai_uts / 100) * b.pengetahuan_nilai_uts) +
						((b.persentasepenilaian_pengetahuan_nilai_uas / 100) * b.pengetahuan_nilai_uas)
					) AS pengetahuan_nilai_rapor_dayah
				FROM (
					SELECT 
						a.*,
						(SELECT penilaiandayah.pengetahuan_tnh FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = a.id AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_tnh,
						(SELECT penilaiandayah.pengetahuan_nilai_uts FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = a.id AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uts,
						(SELECT penilaiandayah.pengetahuan_nilai_uas FROM penilaiandayah WHERE penilaiandayah.mapeldayah_id = a.id AND penilaiandayah.penempatansiswa_id = {$penempatansiswa_id} LIMIT 1) as pengetahuan_nilai_uas,
						
						(SELECT pengetahuan_tnh FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = a.id) AS persentasepenilaian_pengetahuan_tnh,
						(SELECT pengetahuan_nilai_uts FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = a.id) AS persentasepenilaian_pengetahuan_nilai_uts,
						(SELECT pengetahuan_nilai_uas FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = a.id) AS persentasepenilaian_pengetahuan_nilai_uas
						
					FROM (
						SELECT
						mapeldayah.id,
						mapeldayah.mapel,
						mapeldayah.mapel_hijaiyah,
						mapeldayah.kelas_id,
						mapeldayah.guru_id,
						guru.nama AS guru
						FROM
						mapeldayah
						INNER JOIN guru ON mapeldayah.guru_id = guru.id
						WHERE 
						mapeldayah.kelas_id = {$kelas_id} AND 
						mapeldayah.semester_id = {$semester_id}
					) a
				) b";



		$query = $this->db->query($sql);
		if($query->num_rows()){
			return $query->result();
		}

		return [];
	}

	public function get_nilai_rapor_dayah_rata_rata($kelas_id, $semester_id, $mapeldayah_id){

		$sql = "SELECT 
					SUM(b.pengetahuan_nilai_rapor_dayah) AS pengetahuan_nilai_rapor_dayah_rata_rata
				FROM (
					SELECT 
						a.*,
						ROUND(
							((a.persentasepenilaian_pengetahuan_tnh / 100) * a.pengetahuan_tnh) +
							((a.persentasepenilaian_pengetahuan_nilai_uts / 100) * a.pengetahuan_nilai_uts) +
							((a.persentasepenilaian_pengetahuan_nilai_uas / 100) * a.pengetahuan_nilai_uas)
						) AS pengetahuan_nilai_rapor_dayah
					FROM (
							SELECT
							penilaiandayah.mapeldayah_id,
							penilaiandayah.pengetahuan_tnh,
							penilaiandayah.pengetahuan_nilai_uts,
							penilaiandayah.pengetahuan_nilai_uas,
							(SELECT pengetahuan_tnh FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = penilaiandayah.mapeldayah_id) AS persentasepenilaian_pengetahuan_tnh,
							(SELECT pengetahuan_nilai_uts FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = penilaiandayah.mapeldayah_id) AS persentasepenilaian_pengetahuan_nilai_uts,
							(SELECT pengetahuan_nilai_uas FROM persentasepenilaiandayah WHERE persentasepenilaiandayah.mapeldayah_id = penilaiandayah.mapeldayah_id) AS persentasepenilaian_pengetahuan_nilai_uas
						FROM
							penilaiandayah
						INNER JOIN 
							mapeldayah ON penilaiandayah.mapeldayah_id = mapeldayah.id
						WHERE 
							mapeldayah.kelas_id = {$kelas_id} AND 
							mapeldayah.semester_id = {$semester_id} AND 
							penilaiandayah.mapeldayah_id = {$mapeldayah_id}

					) a
				) b ";

		

		$query = $this->db->query($sql);
		return $query->row()->pengetahuan_nilai_rapor_dayah_rata_rata;
	}
}