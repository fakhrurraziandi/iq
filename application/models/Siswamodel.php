<?php 

class Siswamodel extends CI_Model{
	public function find($siswa_id){
		$query = $this->db->query("SELECT * FROM siswa WHERE siswa.id = {$siswa_id}");
		if($query->num_rows() > 0){
			return $query->row();
		}else{
			return false;
		}
	}
}