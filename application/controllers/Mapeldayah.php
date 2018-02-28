<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Mapeldayah extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Kelasmodel');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();
		$data['tingkat']     = $this->Tingkatmodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('mapeldayah/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_combo_mapel(){

		header('Content-Type: application/json');

		$result = [];

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$guru_id = $this->session->userdata('guru_id');
		$where_guru_id = '';
		if(!is_null($guru_id)){
			$where_guru_id = " AND mapeldayah.guru_id = {$guru_id} ";
		}

		$sql = "SELECT * FROM (
						SELECT
							mapeldayah.id,
							mapeldayah.mapel,
							mapeldayah.mapel_hijaiyah,
							mapeldayah.kelas_id,
							mapeldayah.guru_id,
							mapeldayah.semester_id,
							guru.nama as guru,
							guru.kode,
							guru.nip_nignp
						FROM
							mapeldayah
						LEFT JOIN guru ON mapeldayah.guru_id = guru.id

						WHERE 
							mapeldayah.kelas_id = {$kelas_id} AND 
							mapeldayah.semester_id = {$semester_id}
							$where_guru_id
					) x ";
		$query = $this->db->query($sql);

		if($query->num_rows() > 0){
			echo json_encode($query->result());
		}else{
			echo json_encode([]);
		}
	}

	public function json_parent_mapel(){

		
		header('Content-Type: application/json');

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT 
										mapel.*,
										(SELECT COUNT(*) FROM mapel m WHERE m.parent = 0 AND m.parent_id = mapel.id) AS has_child
									FROM mapel WHERE mapel.parent = 1 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
		if($query->num_rows() > 0){
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

		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : 10;
		$semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($kelas_id AND $semester_id){

			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT * FROM (
						SELECT
							mapeldayah.id,
							mapeldayah.mapel,
							mapeldayah.mapel_hijaiyah,
							mapeldayah.kelas_id,
							mapeldayah.guru_id,
							mapeldayah.semester_id,
							guru.nama as guru,
							guru.kode,
							guru.nip_nignp
						FROM
							mapeldayah
						LEFT JOIN guru ON mapeldayah.guru_id = guru.id

						WHERE 
							mapeldayah.kelas_id = {$kelas_id} AND 
							mapeldayah.semester_id = {$semester_id}
					) x ";

			if($search !== ''){
			    $sql .= "WHERE
			                x.mapel LIKE '%". $search ."%' OR 
			                x.mapel_hijaiyah LIKE '%". $search ."%' OR 
			                x.guru LIKE '%". $search ."%' ";
			}

		    $sql .= " ORDER BY x.id";

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

		$this->form_validation->set_rules('mapel', 'mapel', 'required');
		$this->form_validation->set_rules('mapel_hijaiyah', 'mapel_hijaiyah', 'required');
		// $this->form_validation->set_rules('kelas_id', 'kelas_id', 'required');
		$this->form_validation->set_rules('guru_id', 'guru_id', 'required');
		
		// $this->form_validation->set_rules('semester_id', 'semester_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'mapel'          => $this->input->post('mapel'),
				'mapel_hijaiyah' => $this->input->post('mapel_hijaiyah'),
				'kelas_id'       => $this->input->post('kelas_id'),
				'guru_id'        => $this->input->post('guru_id'),
				'semester_id'    => $this->input->post('semester_id')
			];

			$insert = $this->db->insert('mapeldayah', $formData);

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
      	$id = $this->input->get('id');
        $query = $this->db->query("SELECT * FROM mapeldayah WHERE mapeldayah.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

   

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('mapel', 'mapel', 'required');
        $this->form_validation->set_rules('mapel_hijaiyah', 'mapel_hijaiyah', 'required');
        $this->form_validation->set_rules('guru_id', 'guru_id', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'mapel'            => $this->input->post('mapel'),
				'mapel_hijaiyah' => $this->input->post('mapel_hijaiyah'),
				'guru_id'          => $this->input->post('guru_id'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('mapeldayah', $data);
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
        $query = $this->db->delete('mapeldayah');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}