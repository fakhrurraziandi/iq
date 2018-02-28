<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Trackrecord extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Siswamodel');
		$this->load->model('Trackrecordmodel');
		$this->load->model('JenisTrackrecordmodel');
	}

	public function index(){
		$data['siswa_id'] = $this->input->get('siswa_id');
		$data['trackrecord'] = $this->Trackrecordmodel->get_where_siswa_id($data['siswa_id']);
		$data['jenistrackrecord'] = $this->JenisTrackrecordmodel->all();
		$data['siswa'] = $this->Siswamodel->find($data['siswa_id']);


		$this->load->view('templates/header');
		$this->load->view('templates/nav-'. $this->session->userdata('group'));
		$this->load->view('trackrecord/index', $data);
		$this->load->view('templates/footer');
	}

	public function json_where_tahunajaran_id_tingkat_id(){
		header('Content-Type: application/json');
		$tahunajaran_id = $this->input->get('tahunajaran_id');
		$tingkat_id     = $this->input->get('tingkat_id');

		$result = $this->Trackrecordmodel->get_by_tahunajaran_and_tingkat($tahunajaran_id, $tingkat_id);
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
		$siswa_id  = ($this->input->get('siswa_id')) ? $this->input->get('siswa_id') : '';

		$sql = "SELECT
					*
				FROM
					(
						SELECT
							trackrecord.id,
							trackrecord.siswa_id,
							trackrecord.jenistrackrecord_id,
							trackrecord.deskripsi,
							trackrecord.tanggal,
							jenistrackrecord.jenistrackrecord
						FROM
							trackrecord
						INNER JOIN jenistrackrecord ON trackrecord.jenistrackrecord_id = jenistrackrecord.id
						WHERE trackrecord.siswa_id = {$siswa_id}

					) x ";

		if($search !== ''){
		    $sql .= "WHERE
		    			x.id '%". $search ."%' OR 
						x.siswa_id '%". $search ."%' OR 
						x.jenistrackrecord_id '%". $search ."%' OR 
						x.deskripsi '%". $search ."%' OR 
						x.tanggal '%". $search ."%' OR 
						x.jenistrackrecord '%". $search ."%' ";
		}

		if($sort !== ''){
		    $sql .= "ORDER BY x.". $sort . " " . $order. " ";
		}else{
		    $sql .= "ORDER BY x.tanggal, x.jenistrackrecord_id ";
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

		

		$this->form_validation->set_rules('jenistrackrecord_id', 'jenistrackrecord', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'jenistrackrecord_id' => $this->input->post('jenistrackrecord_id'),
				'tanggal'             => $this->input->post('tanggal'),
				'deskripsi'           => $this->input->post('deskripsi'),
				'siswa_id'            => $this->input->post('siswa_id'),
			];

			$insert = $this->db->insert('trackrecord', $formData);

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
        $query = $this->db->get_where('trackrecord', $data);
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];



		$this->form_validation->set_rules('jenistrackrecord_id', 'jenistrackrecord', 'required');
		$this->form_validation->set_rules('tanggal', 'tanggal', 'required');
		$this->form_validation->set_rules('deskripsi', 'deskripsi', 'required');


		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$id = $this->input->post('id');
			$formData = [
				'jenistrackrecord_id' => $this->input->post('jenistrackrecord_id'),
				'tanggal'             => $this->input->post('tanggal'),
				'deskripsi'           => $this->input->post('deskripsi'),
				'siswa_id'            => $this->input->post('siswa_id'),
			];
            $this->db->where('id', $id);
            $query = $this->db->update('trackrecord', $formData);
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
        $query = $this->db->delete('trackrecord');
        if($query){
            $result['status'] = 'success';
        }else{
            $result['status'] = 'error';
        }

        echo json_encode($result);
    }
}