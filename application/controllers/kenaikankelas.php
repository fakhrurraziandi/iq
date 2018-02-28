<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Kenaikankelas extends Backend {

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
		$this->load->view('kenaikankelas/index', $data);
		$this->load->view('templates/footer');
	}

	public function naikkelas(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
		];

		$siswa_id = $this->input->post('siswa_id');
		$sql_update_siswa = "UPDATE siswa SET siswa.tingkat_id = (siswa.tingkat_id + 1), siswa.tahunajaran_id = (siswa.tahunajaran_id + 1), siswa.kelas_id = null WHERE siswa.id = {$siswa_id} ";
		$update_siswa = $this->db->query($sql_update_siswa);

		$penempatansiswa_id = $this->input->post('penempatansiswa_id');
		$sql_update_penempatansiswa = "UPDATE penempatansiswa SET penempatansiswa.status_kenaikankelas = 1 WHERE penempatansiswa.id = {$penempatansiswa_id}";
		$update_penempatansiswa = $this->db->query($sql_update_penempatansiswa);

		if($update_siswa && $update_penempatansiswa){
			$result['status'] = 'success';
		}else{
			$result['status'] = 'error';
		}


		echo json_encode($result);

	}

	public function tinggalkelas(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
		];

		$siswa_id = $this->input->post('siswa_id');
		$sql_update_siswa = "UPDATE siswa SET siswa.tahunajaran_id = (siswa.tahunajaran_id + 1), siswa.kelas_id = null WHERE siswa.id = {$siswa_id} ";
		$update_siswa = $this->db->query($sql_update_siswa);

		$penempatansiswa_id = $this->input->post('penempatansiswa_id');
		$sql_update_penempatansiswa = "UPDATE penempatansiswa SET penempatansiswa.status_kenaikankelas = 0 WHERE penempatansiswa.id = {$penempatansiswa_id}";
		$update_penempatansiswa = $this->db->query($sql_update_penempatansiswa);

		if($update_siswa && $update_penempatansiswa){
			$result['status'] = 'success';
		}else{
			$result['status'] = 'error';
		}


		echo json_encode($result);

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

			$sql = "SELECT x.* FROM (
						SELECT
							penempatansiswa.id,
							penempatansiswa.kelas_id,
							penempatansiswa.siswa_id,
							penempatansiswa.status_kenaikankelas,
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

    

   
}