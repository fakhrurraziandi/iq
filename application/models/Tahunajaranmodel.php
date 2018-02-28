<?php 

class Tahunajaranmodel extends CI_Model{
	public function all(){
		$query = $this->db->query("SELECT
						            tahunajaran.id,
						            CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran
						        FROM tahunajaran ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}