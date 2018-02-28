<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Penempatansiswa extends Backend {

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
		$this->load->view('penempatansiswa/index', $data);
		$this->load->view('templates/footer');
	}

	public function siswa_in(){
		
		$siswa_id = $this->input->post('siswa_id');
		$kelas_id = $this->input->post('kelas_id');

		$insert = $this->db->query("INSERT INTO penempatansiswa (kelas_id, siswa_id) VALUES ({$kelas_id}, {$siswa_id})");
		if($insert){
			$update = $this->db->query("UPDATE siswa SET siswa.kelas_id = {$kelas_id} WHERE siswa.id = {$siswa_id}");
			echo 'success';
		}else{
			echo 'error';
		}
	}

	public function siswa_out(){
		
		$message = '';
		
		$id = $this->input->post('id'); // penempatansiswa.id
		$siswa_id = $this->input->post('siswa_id');

		$query = $this->db->query("SELECT COUNT(*) AS jumlah_penilaian FROM `penilaian` WHERE penilaian.penempatansiswa_id = $id");
		$jumlah_penilaian = (integer) $query->row()->jumlah_penilaian;

		if($jumlah_penilaian == 0){
			$delete = $this->db->query("DELETE FROM penempatansiswa WHERE penempatansiswa.id = {$id}");
			if($delete){
				$update = $this->db->query("UPDATE siswa SET siswa.kelas_id = NULL WHERE siswa.id = {$siswa_id}");
				echo 'success';
			}else{
				echo 'error';
			}
		}else{
			echo 'error';
		}

			
	}

	public function json_out_kelas(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$tingkat_id = ($this->input->get('tingkat_id')) ? $this->input->get('tingkat_id') : false;
		$tahunajaran_id = ($this->input->get('tahunajaran_id')) ? $this->input->get('tahunajaran_id') : false;

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		if($tingkat_id AND $tahunajaran_id){

			$sql = "SELECT * FROM (
						SELECT
							siswa.id,
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin,
							siswa.tingkat_id
						FROM
							siswa
						WHERE 
						siswa.tingkat_id = {$tingkat_id} AND 
						siswa.tahunajaran_id = {$tahunajaran_id} AND 
						siswa.kelas_id IS NULL
					) x ";

			if($search !== ''){
			    $sql .= "WHERE
			    			x.nisn '%". $search ."%' OR 
							x.nis_lokal '%". $search ."%' OR 
							x.nama '%". $search ."%' OR 
							x.jenis_kelamin '%". $search ."%' ";
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

		}else{
			$result['rows'] = [];
		}


		echo json_encode($result);

	}

	public function json_in_kelas(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$kelas_id = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;

		$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
		$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
		$search = ($this->input->get('search')) ? $this->input->get('search') : '';
		$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
		$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

		if($kelas_id){

			$sql = "SELECT
						*
					FROM
						(
							SELECT
								penempatansiswa.id,
								penempatansiswa.kelas_id,
								penempatansiswa.siswa_id,
								siswa.nisn,
								siswa.nis_lokal,
								siswa.nama,
								siswa.jenis_kelamin
							FROM
								penempatansiswa
							INNER JOIN siswa ON penempatansiswa.siswa_id = siswa.id
							INNER JOIN kelas ON penempatansiswa.kelas_id = kelas.id
							WHERE penempatansiswa.kelas_id = {$kelas_id}
						) x ";

			if($search !== ''){
			    $sql .= "WHERE
			    			x.nisn LIKE '%". $search ."%' OR 
							x.nis_lokal LIKE '%". $search ."%' OR 
							x.nama LIKE '%". $search ."%' OR 
							x.jenis_kelamin LIKE '%". $search ."%' ";
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

		}else{
			$result['rows'] = [];
		}


		echo json_encode($result);

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
		            siswa.id,
		            siswa.nisn,
		            siswa.nis_lokal,
		            siswa.nama,
		            siswa.jenis_kelamin
		        FROM siswa ";

		if($search !== ''){
		    $sql .= "WHERE
		                siswa.id LIKE '%". $search ."%' OR
		                siswa.nisn LIKE '%". $search ."%' OR
		                siswa.nis_lokal LIKE '%". $search ."%' OR
		                siswa.nama LIKE '%". $search ."%' OR
		                siswa.jenis_kelamin LIKE '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY siswa.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY siswa.nisn ASC ";
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

			$insert = $this->db->insert('siswa', $formData);

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
        $query = $this->db->get_where('siswa', $data);
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
            $query = $this->db->update('siswa', $data);
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
        $query = $this->db->delete('siswa');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}