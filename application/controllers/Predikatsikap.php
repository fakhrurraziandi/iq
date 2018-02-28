<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Predikatsikap extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$mapel_id  = ($this->input->get('mapel_id')) ? $this->input->get('mapel_id') : false;

		if($mapel_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT * FROM (
						SELECT
							predikatsikap.id,
							predikatsikap.mapel_id,
							predikatsikap.huruf,
							predikatsikap.deskripsi,
							predikatsikap.lebih_kecil_atau_sama_dengan
						FROM `predikatsikap`
						WHERE predikatsikap.mapel_id = {$mapel_id}

					) x ";

			if($search !== ''){
			    $sql .= "WHERE
			    			x.huruf LIKE '%". $search ."%' OR
							x.deskripsi LIKE '%". $search ."%' OR
							x.lebih_kecil_atau_sama_dengan LIKE '%". $search ."%' ";
			}

			
			$sql .= "ORDER BY x.id DESC ";
			

			$query = $this->db->query($sql);
			$result['total'] = $query->num_rows();

			$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
			$result['rows'] = $query_limit->result();
		}

			


		echo json_encode($result);

	}

	

	public function find(){

        header('Content-Type: application/json');
        $result = '';
        $data = [
            'id' => $this->input->get('id')
        ];
        $query = $this->db->get_where('predikatsikap', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        // $this->form_validation->set_rules('deskripsi', 'Deskripsi', 'required');

        // if($this->form_validation->run() == false){
        //     $result['status'] = 'error';
        //     $result['error_messages'] = $this->form_validation->error_array();
        // }else{
            $id = $this->input->post('id');
            $data = [
				'deskripsi'          => $this->input->post('deskripsi'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('predikatsikap', $data);
            if($query){
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
                $result['error_messages'] = [];
            }
        // }

        echo json_encode($result);
    }

}