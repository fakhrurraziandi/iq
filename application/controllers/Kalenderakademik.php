<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Kalenderakademik extends Backend {

	public function __construct(){
		parent::__construct();
	}

	public function index(){
		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('kalenderakademik/index');
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
					kalenderakademik.id,
					kalenderakademik.tanggal,
					kalenderakademik.keterangan
				FROM
					kalenderakademik ";

		if($search !== ''){
		    $sql .= "WHERE
		    			kalenderakademik.id LIKE '%". $search ."%' OR
						kalenderakademik.tanggal LIKE '%". $search ."%' OR
						kalenderakademik.keterangan LIKE '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY kalenderakademik.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY kalenderakademik.tanggal ASC ";
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

		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('keterangan', 'keterangan', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'tanggal'  => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
			];

			$insert = $this->db->insert('kalenderakademik', $formData);

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
        $query = $this->db->get_where('kalenderakademik', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('tanggal', 'tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'keterangan', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'tanggal'  => $this->input->post('tanggal'),
				'keterangan' => $this->input->post('keterangan'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('kalenderakademik', $data);
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
        $query = $this->db->delete('kalenderakademik');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}