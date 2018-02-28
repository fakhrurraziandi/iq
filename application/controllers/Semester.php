<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Semester extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('semester/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_where_tahunajaran_id(){
		header('Content-Type: application/json');
		$tahunajaran_id = $this->input->get('tahunajaran_id');

		$query = $this->db->query("SELECT
										semester.id,
										semester.tahunajaran_id,
										CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir, ' ', semester.ganjil_genap) AS semester
									FROM
										semester 
									LEFT JOIN tahunajaran ON semester.tahunajaran_id = tahunajaran.id 
									WHERE semester.tahunajaran_id = {$tahunajaran_id}");
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

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		$sql = "SELECT * FROM (
					SELECT
						semester.id,
						semester.tahunajaran_id,
						CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran,
						CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir, ' ', semester.ganjil_genap) AS semester
					FROM
						semester
					LEFT JOIN tahunajaran ON semester.tahunajaran_id = tahunajaran.id 
				) x ";

		if($search !== ''){
		    $sql .= "WHERE
		                x.tahunajaran LIKE '%". $search ."%' OR
		                x.semester LIKE '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY x.semester ASC ";
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

		$this->form_validation->set_rules('nisn', 'nisn', 'required');
		$this->form_validation->set_rules('nis_lokal', 'nis_lokal', 'required');
		$this->form_validation->set_rules('nama', 'nama', 'required');
		$this->form_validation->set_rules('jenis_kelamin', 'jenis_kelamin', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'nisn'          => $this->input->post('nisn'),
				'nis_lokal'     => $this->input->post('nis_lokal'),
				'nama'          => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
			];

			$insert = $this->db->insert('semester', $formData);

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
        $query = $this->db->get_where('semester', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('nisn', 'NISN', 'required');
        $this->form_validation->set_rules('nis_lokal', 'NIS Lokal', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('jenis_kelamin', 'Jenis Kelamin', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'nisn'          => $this->input->post('nisn'),
				'nis_lokal'     => $this->input->post('nis_lokal'),
				'nama'          => $this->input->post('nama'),
				'jenis_kelamin' => $this->input->post('jenis_kelamin'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('semester', $data);
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
        $query = $this->db->delete('semester');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}