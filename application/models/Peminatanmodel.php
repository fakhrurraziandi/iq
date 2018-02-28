<?php 

class Peminatanmodel extends CI_Model{
	public function all(){
		$query = $this->db->query("SELECT * FROM peminatan ");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return false;
		}
	}
}