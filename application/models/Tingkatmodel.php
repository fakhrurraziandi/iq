<?php 

class Tingkatmodel extends CI_Model{
	public function all(){
		$query = $this->db->query("SELECT * FROM tingkat ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}