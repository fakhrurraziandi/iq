<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Peminatanmodel');
		$this->load->model('Gurumodel');
		$this->load->model('Kelasmodel');
	}

	public function index(){

		$data['tahunajaran'] = $this->Tahunajaranmodel->all();
		$data['tingkat']     = $this->Tingkatmodel->all();
		$data['peminatan']   = $this->Peminatanmodel->all();
		$data['guru']        = $this->Gurumodel->all();

		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('kelas/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_where_tahunajaran_id_tingkat_id(){
		header('Content-Type: application/json');
		$tahunajaran_id = $this->input->get('tahunajaran_id');
		$tingkat_id     = $this->input->get('tingkat_id');

		$result = $this->Kelasmodel->get_by_tahunajaran_and_tingkat($tahunajaran_id, $tingkat_id);
		if($result){
			echo json_encode($result);
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

		$sql = "SELECT
					*
				FROM
					(
						SELECT
							kelas.id,
							kelas.tingkat_id,
							kelas.peminatan_id,
							kelas.guru_id,
							kelas.tahunajaran_id,
							CONCAT(tingkat.tingkat, '-', kelas.paralel, ' ', peminatan.peminatan , ' ' ,  tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS kelas,
							tingkat.tingkat,
							peminatan.peminatan, 
							guru.nama AS guru,
							CONCAT(tahunajaran.tahun_awal, '/', tahunajaran.tahun_akhir) AS tahunajaran
						FROM
							kelas
						LEFT JOIN peminatan ON kelas.peminatan_id = peminatan.id
						LEFT JOIN tingkat ON kelas.tingkat_id = tingkat.id
						LEFT JOIN guru ON kelas.guru_id = guru.id
						LEFT JOIN tahunajaran ON kelas.tahunajaran_id = tahunajaran.id
					) x ";

		if($search !== ''){
		    $sql .= "WHERE
		    			x.kelas '%". $search ."%' OR 
						x.tingkat '%". $search ."%' OR 
						x.peminatan '%". $search ."%' OR 
						x.tahunajaran '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY x.tahunajaran, x.peminatan, x.tingkat, x.kelas ASC ";
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

		

		$this->form_validation->set_rules('tingkat_id', 'tingkat_id', 'required');
		// $this->form_validation->set_rules('peminatan_id', 'peminatan_id', 'required');
		// $this->form_validation->set_rules('paralel', 'paralel', 'required');
		// $this->form_validation->set_rules('guru_id', 'guru_id', 'required');
		$this->form_validation->set_rules('tahunajaran_id', 'tahunajaran_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'tingkat_id'     => $this->input->post('tingkat_id'),
				'peminatan_id'   => $this->input->post('peminatan_id'),
				'paralel'        => $this->input->post('paralel'),
				'guru_id'        => $this->input->post('guru_id'),
				'tahunajaran_id' => $this->input->post('tahunajaran_id'),
			];

			$insert = $this->db->insert('kelas', $formData);

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
        $query = $this->db->get_where('kelas', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];



		$this->form_validation->set_rules('tingkat_id', 'tingkat_id', 'required');
		// $this->form_validation->set_rules('peminatan_id', 'peminatan_id', 'required');
		// $this->form_validation->set_rules('paralel', 'paralel', 'required');
		// $this->form_validation->set_rules('guru_id', 'guru_id', 'required');
		$this->form_validation->set_rules('tahunajaran_id', 'tahunajaran_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$id = $this->input->post('id');
			$formData = [
				'tingkat_id'     => $this->input->post('tingkat_id'),
				'peminatan_id'   => $this->input->post('peminatan_id'),
				'paralel'        => $this->input->post('paralel'),
				'guru_id'        => $this->input->post('guru_id'),
				'tahunajaran_id' => $this->input->post('tahunajaran_id'),
			];
            $this->db->where('id', $id);
            $query = $this->db->update('kelas', $formData);
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
        $query = $this->db->delete('kelas');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}