<?php

class Jenistrackrecordmodel extends CI_Model{
	public function all(){
		$query = $this->db->query("SELECT * FROM jenistrackrecord");
		if($query->num_rows() > 0){
			return $query->result();
		}else{
			return [];
		}
	}
}