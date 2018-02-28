<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Tahunajaran extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('tahunajaran/index');
		$this->load->view('templates/footer');
	}

	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		$sql = "SELECT
		            tahunajaran.id,
		            CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran
		        FROM tahunajaran ";

		if($search !== ''){
		    $sql .= "WHERE
		                tahunajaran.id LIKE '%". $search ."%' OR
		                tahunajaran.tahun_awal LIKE '%". $search ."%' OR
		                tahunajaran.tahun_akhir LIKE '%". $search ."%'  ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY tahunajaran.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY tahunajaran.tahun_awal ASC ";
		}

		$query = $this->db->query($sql);
		$result['total'] = $query->num_rows();

		$query_limit = $this->db->query($sql . " LIMIT ". $offset . ", ". $limit);
		$result['rows'] = $query_limit->result();


		echo json_encode($result);

	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$this->form_validation->set_rules('tahun_awal', 'tahun awal', 'required');
		$this->form_validation->set_rules('tahun_akhir', 'tahun akhir', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'tahun_awal'  => $this->input->post('tahun_awal'),
				'tahun_akhir' => $this->input->post('tahun_akhir'),
			];

			$insert = $this->db->insert('tahunajaran', $formData);

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
        $query = $this->db->get_where('tahunajaran', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('tahun_awal', 'tahun awal', 'required');
        $this->form_validation->set_rules('tahun_akhir', 'tahun akhir', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'tahun_awal'  => $this->input->post('tahun_awal'),
				'tahun_akhir' => $this->input->post('tahun_akhir'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('tahunajaran', $data);
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
        $query = $this->db->delete('tahunajaran');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}