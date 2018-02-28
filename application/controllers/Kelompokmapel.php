<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelompokmapel extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function json_where_kelas_id_and_semester_id(){

		header('Content-Type: application/json');
		
		$kelas_id    = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$sql = "SELECT
					*
				FROM
					(
						SELECT
							kelompokmapel.id,
							kelompokmapel.kelompokmapel,
							kelompokmapel.kelas_id
						FROM
							`kelompokmapel`
						WHERE
							kelompokmapel.kelas_id = {$kelas_id} AND 
							kelompokmapel.semester_id = {$semester_id} 

					) x ";

		$query = $this->db->query($sql);
		if($query->num_rows()){
			echo json_encode($query->result());
		}else{
			echo json_encode([]);
		}
	}

	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		$semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : false;

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		if($kelas_id AND $semester_id){
			$sql = "SELECT
						*
					FROM
						(
							SELECT
								kelompokmapel.id,
								kelompokmapel.kelompokmapel,
								kelompokmapel.kelas_id
							FROM
								`kelompokmapel`
							WHERE
								kelompokmapel.kelas_id = {$kelas_id} AND 
								kelompokmapel.semester_id = {$semester_id} 

						) x ";

			if($search !== ''){
			    $sql .= "WHERE
			                x.kelompokmapel LIKE '%". $search ."%' ";
			}

			if($sort !== ''){
			    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
			}else{
			    $sql .= "ORDER BY x.id ASC ";
			}

			$query = $this->db->query($sql);
			$result['total'] = $query->num_rows();

			$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
			$result['rows'] = $query_limit->result();
		}

		echo json_encode($result);

	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$this->form_validation->set_rules('kelompokmapel', 'kelompokmapel', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'kelompokmapel' => $this->input->post('kelompokmapel'),
				'kelas_id'      => $this->input->post('kelas_id'),
				'semester_id'    => $this->input->post('semester_id'),
			];

			$insert = $this->db->insert('kelompokmapel', $formData);

			if($insert){
				$result['status'] = 'success';
			}else{
				$result['status'] = 'error';
			}
		}

		echo json_encode($result);
	}

	public function find(){

        header('Content-Type: application/json');
        $result = '';
        $data = [
            'id' => $this->input->get('id')
        ];
        $query = $this->db->get_where('kelompokmapel', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('kelompokmapel', 'kelompokmapel', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
			$kelompokmapel = $this->input->post('kelompokmapel');
            
            $query = $this->db->query("UPDATE kelompokmapel SET kelompokmapel.kelompokmapel = '{$kelompokmapel}' WHERE kelompokmapel.id = {$id} ");


            if($query){
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
            }
        }

        echo json_encode($result);
    }

    public function delete(){

        header('Content-Type: application/json');

        $id = $this->input->post('id');
        $this->db->where('id', $id);
        $query = $this->db->delete('kelompokmapel');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}