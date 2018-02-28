<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Rekapabsen extends Backend {

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
		$this->load->view('rekapabsen/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_parent_mapel(){

		header('Content-Type: application/json');

		$kelas_id = $this->input->get('kelas_id');
		$semester_id = $this->input->get('semester_id');

		$query = $this->db->query("SELECT * FROM mapel WHERE mapel.parent = 1 AND mapel.kelas_id = {$kelas_id} AND mapel.semester_id = {$semester_id}");
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
			// 'rows' => []
		];

		$semester_id = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : false;
		$kelas_id  = ($this->input->get('kelas_id')) ? $this->input->get('kelas_id') : false;
		// $semester_id  = ($this->input->get('semester_id')) ? $this->input->get('semester_id') : 10;

		if($semester_id AND $kelas_id){
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
							siswa.nisn,
							siswa.nis_lokal,
							siswa.nama,
							siswa.jenis_kelamin,
							(SELECT rekapabsen.id FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = penempatansiswa.id AND rekapabsen.semester_id = {$semester_id}) AS rekapabsen_id,
							(SELECT rekapabsen.sakit FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = penempatansiswa.id AND rekapabsen.semester_id = {$semester_id}) AS sakit,
							(SELECT rekapabsen.izin FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = penempatansiswa.id AND rekapabsen.semester_id = {$semester_id}) AS izin,
							(SELECT rekapabsen.alpha FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = penempatansiswa.id AND rekapabsen.semester_id = {$semester_id}) AS alpha,
							(SELECT rekapabsen.hadir FROM rekapabsen WHERE rekapabsen.penempatansiswa_id = penempatansiswa.id AND rekapabsen.semester_id = {$semester_id}) AS hadir
							
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


		
		$this->form_validation->set_rules('sakit', 'sakit', 'required');
		$this->form_validation->set_rules('izin', 'izin', 'required');
		$this->form_validation->set_rules('alpha', 'alpha', 'required');
		$this->form_validation->set_rules('hadir', 'hadir', 'required');
		

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'penempatansiswa_id' => $this->input->post('penempatansiswa_id'),
				'semester_id'        => $this->input->post('semester_id'),
				'sakit'              => $this->input->post('sakit'),
				'izin'               => $this->input->post('izin'),
				'alpha'              => $this->input->post('alpha'),
				'hadir'              => $this->input->post('hadir'),
			];

			$insert = $this->db->insert('rekapabsen', $formData);

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
        $query = $this->db->query("SELECT * FROM `rekapabsen` WHERE rekapabsen.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('sakit', 'sakit', 'required');
		$this->form_validation->set_rules('izin', 'izin', 'required');
		$this->form_validation->set_rules('alpha', 'alpha', 'required');
		$this->form_validation->set_rules('hadir', 'hadir', 'required');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'sakit' => $this->input->post('sakit'),
				'izin'  => $this->input->post('izin'),
				'alpha' => $this->input->post('alpha'),
				'hadir' => $this->input->post('hadir'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('rekapabsen', $data);
            if($query){
                $result['status'] = 'success';
            }else{
                $result['status'] = 'error';
            }
        }

        echo json_encode($result);
    }

   
}