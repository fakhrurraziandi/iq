<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaiantahfizh extends Backend {

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
		$this->load->view('penilaiantahfizh/index', $data);
		$this->load->view('templates/footer');
	}



	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			// 'rows' => []
		];

		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;

		if($kelas_id){
			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT * FROM (
						SELECT
							penempatansiswa.id,
							penempatansiswa.kelas_id,
							penempatansiswa.siswa_id,
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin,
							penilaiantahfizh.id as penilaiantahfizh_id,
							penilaiantahfizh.jumlah_hafalan,
							penilaiantahfizh.hafalan_yang_diujiankan,
							penilaiantahfizh.nilai
							
						FROM
							penempatansiswa
						INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
						INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
						LEFT JOIN penilaiantahfizh ON penempatansiswa.id = penilaiantahfizh.penempatansiswa_id
						WHERE penempatansiswa.kelas_id = {$kelas_id} 
					) x ";

			// echo $sql;

			if($search !== ''){
			    $sql .= "WHERE
			                x.nisn LIKE '%". $search ."%' OR
			                x.nis_lokal LIKE '%". $search ."%' OR
			                x.nama LIKE '%". $search ."%' ";
			}

			if($sort !== ''){
			    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
			}else{
			    $sql .= "ORDER BY x.nisn, x.nis_lokal, x.nama ASC ";
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

		$this->form_validation->set_rules('jumlah_hafalan', 'jumlah_hafalan', 'required');
		$this->form_validation->set_rules('hafalan_yang_diujiankan', 'hafalan_yang_diujiankan', 'required');
		$this->form_validation->set_rules('nilai', 'nilai', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'penempatansiswa_id'          => $this->input->post('penempatansiswa_id'),
				'jumlah_hafalan'          => $this->input->post('jumlah_hafalan'),
				'hafalan_yang_diujiankan' => $this->input->post('hafalan_yang_diujiankan'),
				'nilai'                   => $this->input->post('nilai'),
			];

			$insert = $this->db->insert('penilaiantahfizh', $formData);

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
        $query = $this->db->query("SELECT * FROM `penilaiantahfizh` WHERE penilaiantahfizh.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('jumlah_hafalan', 'jumlah_hafalan', 'required');
        $this->form_validation->set_rules('hafalan_yang_diujiankan', 'hafalan_yang_diujiankan', 'required');
        $this->form_validation->set_rules('nilai', 'nilai', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'jumlah_hafalan'          => $this->input->post('jumlah_hafalan'),
				'hafalan_yang_diujiankan' => $this->input->post('hafalan_yang_diujiankan'),
				'nilai'                   => $this->input->post('nilai'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('penilaiantahfizh', $data);
            // echo $this->db->last_query();
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
        $query = $this->db->delete('mapel');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }

   
}