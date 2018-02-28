<?php 

class Trackrecordmodel extends CI_Model{
	public function get_where_siswa_id($siswa_id){
		$query = $this->db->query("SELECT * FROM trackrecord WHERE trackrecord.siswa_id = {$siswa_id}");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return [];
		}
	}
}