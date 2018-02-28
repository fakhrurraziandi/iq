<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Penilaianextrakurikuler extends Backend {

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
		$this->load->view('penilaianextrakurikuler/index', $data);
		$this->load->view('templates/footer');
	}



	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			// 'rows' => []
		];

		$tahunajaran_id = ($this->input->get('tahunajaran_id')) ? $this->input->get('tahunajaran_id') : false;
		$semester_id = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : false;
		$tingkat_id = ($this->input->get('tingkat_id')) ? $this->input->get('tingkat_id') : false;
		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		// $semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($semester_id AND $kelas_id){

			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';


			$query_extrakurikuler = $this->db->query("SELECT * FROM extrakurikuler WHERE extrakurikuler.tahunajaran_id = {$tahunajaran_id} AND extrakurikuler.tingkat_id = {$tingkat_id} ");

			$sql_predikat_dan_keterangan = [];
			if($query_extrakurikuler->num_rows()){
				foreach($query_extrakurikuler->result() as $extrakurikuler){
					$sql_predikat_dan_keterangan[] = "	(SELECT penilaianextrakurikuler.extrakurikuler_id FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.penempatansiswa_id = penempatansiswa.id AND penilaianextrakurikuler.semester_id = {$semester_id} AND penilaianextrakurikuler.extrakurikuler_id = ". $extrakurikuler->id ." LIMIT 1) AS ". str_replace(' ', '_', strtolower($extrakurikuler->extrakurikuler)) ."_id,
														(SELECT penilaianextrakurikuler.predikat FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.penempatansiswa_id = penempatansiswa.id AND penilaianextrakurikuler.semester_id = {$semester_id} AND penilaianextrakurikuler.extrakurikuler_id = ". $extrakurikuler->id ." LIMIT 1) AS ". str_replace(' ', '_', strtolower($extrakurikuler->extrakurikuler)) ."_predikat,
														(SELECT penilaianextrakurikuler.keterangan FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.penempatansiswa_id = penempatansiswa.id AND penilaianextrakurikuler.semester_id = {$semester_id} AND penilaianextrakurikuler.extrakurikuler_id = ". $extrakurikuler->id ." LIMIT 1) AS ". str_replace(' ', '_', strtolower($extrakurikuler->extrakurikuler)) ."_keterangan ";
				}
					
			}

			$select_predikat_dan_keterangan = ', ' . implode(', ', $sql_predikat_dan_keterangan);

			$sql = "SELECT x.* FROM (
						SELECT
							penempatansiswa.id,
							penempatansiswa.kelas_id,
							penempatansiswa.siswa_id,
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin,
							(SELECT COUNT(*) FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.penempatansiswa_id = penempatansiswa.id AND penilaianextrakurikuler.semester_id = {$semester_id}) AS has_penilaianextrakurikuler
							{$select_predikat_dan_keterangan}
							
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

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];

		$batch = [];

		foreach ($_POST['predikat'] as $key => $penilaianextrakurikuler) {
			$batch[] = [
				'penempatansiswa_id' => $this->input->post('penempatansiswa_id'),
				'semester_id' => $this->input->post('semester_id'),
				'predikat' => $_POST['predikat'][$key],
				'keterangan' => $_POST['keterangan'][$key],
				'extrakurikuler_id' => $key,
			];
		}

		$insert = $this->db->insert_batch('penilaianextrakurikuler', $batch);

		if($insert){
			$result['status'] = 'success';
		}else{
			$result['status'] = 'error';
		}
	

		echo json_encode($result);
	}

	

	public function find(){

        header('Content-Type: application/json');

        $result = [];

		$tahunajaran_id     = $this->input->get('tahunajaran_id');
		$tingkat_id         = $this->input->get('tingkat_id');
		$penempatansiswa_id = $this->input->get('penempatansiswa_id');
		$semester_id        = $this->input->get('semester_id');

        $query = $this->db->query("SELECT
										extrakurikuler.id,
										extrakurikuler.extrakurikuler,
										extrakurikuler.tahunajaran_id,
										extrakurikuler.tingkat_id,
										(SELECT penilaianextrakurikuler.predikat FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.extrakurikuler_id = extrakurikuler.id AND penilaianextrakurikuler.penempatansiswa_id = {$penempatansiswa_id} AND penilaianextrakurikuler.semester_id = {$semester_id} LIMIT 1) AS predikat,
										(SELECT penilaianextrakurikuler.keterangan FROM penilaianextrakurikuler WHERE penilaianextrakurikuler.extrakurikuler_id = extrakurikuler.id AND penilaianextrakurikuler.penempatansiswa_id = {$penempatansiswa_id} AND penilaianextrakurikuler.semester_id = {$semester_id} LIMIT 1) AS keterangan
									FROM
										extrakurikuler
									WHERE 
										extrakurikuler.tahunajaran_id = {$tahunajaran_id} AND 
										extrakurikuler.tingkat_id = {$tingkat_id} ");
        if($query->num_rows() > 0){
            $result = $query->result();
        }

        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

		$penempatansiswa_id = $this->input->post('penempatansiswa_id');
		$semester_id        = $this->input->post('semester_id');
        $delete = $this->db->query("DELETE FROM penilaianextrakurikuler WHERE penempatansiswa_id = {$penempatansiswa_id} AND semester_id = {$semester_id} ");

        $batch = [];
				
		foreach ($_POST['predikat'] as $key => $penilaianextrakurikuler) {
			$batch[] = [
				'penempatansiswa_id' => $this->input->post('penempatansiswa_id'),
				'semester_id' => $this->input->post('semester_id'),
				'predikat' => $_POST['predikat'][$key],
				'keterangan' => $_POST['keterangan'][$key],
				'extrakurikuler_id' => $key,
			];
		}

		$insert = $this->db->insert_batch('penilaianextrakurikuler', $batch);
        if($insert){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
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