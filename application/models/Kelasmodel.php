<?php 

class Kelasmodel extends CI_Model{
	private $mainSQL = "SELECT
								*
							FROM
								(
									SELECT
										kelas.id,
										kelas.tingkat_id,
										kelas.peminatan_id,
										kelas.guru_id,
										kelas.tahunajaran_id,
										CONCAT(tingkat.tingkat, ' ', peminatan.peminatan , ' ', kelas.paralel, ' ', tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS kelas,
										tingkat.tingkat,
										peminatan.peminatan, 
										guru.nama AS guru,
										CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran
									FROM
										kelas
									LEFT JOIN peminatan ON kelas.peminatan_id = peminatan.id
									LEFT JOIN tingkat ON kelas.tingkat_id = tingkat.id
									LEFT JOIN guru ON kelas.guru_id = guru.id
									LEFT JOIN tahunajaran ON kelas.tahunajaran_id = tahunajaran.id
								) tahunajaran ";

	public function get_by_tahunajaran_and_tingkat($tahunajaran_id, $tingkat_id){

		$sql = $this->mainSQL . " WHERE tahunajaran.tahunajaran_id = {$tahunajaran_id} AND tahunajaran.tingkat_id = {$tingkat_id} ORDER BY tahunajaran.kelas ";
		
		$query = $this->db->query($sql);
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}