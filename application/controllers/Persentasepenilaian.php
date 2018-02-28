<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Persentasepenilaian extends Backend {

	public function __construct(){
		parent::__construct();
		$this->load->model('Tahunajaranmodel');
		$this->load->model('Tingkatmodel');
		$this->load->model('Kelasmodel');
	}

	

	public function json(){

		header('Content-Type: application/json');

		$result = [
			'total' => 0,
			'rows' => []
		];

		$result['rows'][] = new StdClass();
		$result['rows'][0]->id = NULL;
		$result['rows'][0]->mapel_id = NULL;
		$result['rows'][0]->pengetahuan_tnh = 0;
		$result['rows'][0]->pengetahuan_nilai_uts = 0;
		$result['rows'][0]->pengetahuan_nilai_uas = 0;
		$result['rows'][0]->keterampilan_tnh = 0;
		$result['rows'][0]->keterampilan_projek = 0;
		$result['rows'][0]->keterampilan_porto = 0;
		$result['rows'][0]->keterampilan_nilai_uts = 0;
		$result['rows'][0]->keterampilan_nilai_uas = 0;
		$result['rows'][0]->sikap_tnh = 0;
		$result['rows'][0]->sikap_pd = 0;
		$result['rows'][0]->sikap_ps = 0;
		$result['rows'][0]->sikap_jurnal = 0;
		$result['rows'][0]->sikap_nilai_akhir = 0;

		

		$mapel_id  = ($this->input->get('mapel_id')) ? $this->input->get('mapel_id') : false;

		if($mapel_id){

			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT
						persentasepenilaian.id,
						persentasepenilaian.mapel_id,
						persentasepenilaian.pengetahuan_tnh,
						persentasepenilaian.pengetahuan_nilai_uts,
						persentasepenilaian.pengetahuan_nilai_uas,
						persentasepenilaian.keterampilan_tnh,
						persentasepenilaian.keterampilan_projek,
						persentasepenilaian.keterampilan_porto,
						persentasepenilaian.keterampilan_nilai_uts,
						persentasepenilaian.keterampilan_nilai_uas,
						persentasepenilaian.sikap_tnh,
						persentasepenilaian.sikap_pd,
						persentasepenilaian.sikap_ps,
						persentasepenilaian.sikap_jurnal,
						persentasepenilaian.sikap_nilai_akhir
					FROM `persentasepenilaian`
					WHERE persentasepenilaian.mapel_id = {$mapel_id} ORDER BY persentasepenilaian.id DESC LIMIT 1 ";

			$query = $this->db->query($sql);
			if($query->num_rows()){
				$result['total'] = $query->num_rows();
				$result['rows'] = $query->result();
			}
			
		}

		echo json_encode($result);

	}

	public function create(){

		header('Content-Type: application/json');

		$result = [
			'status' => 'success',
			'error_message' => [],
		];


		// $this->form_validation->set_rules('penempatansiswa_id', 'penempatansiswa_id', 'required');
		// $this->form_validation->set_rules('mapel_id', 'mapel_id', 'required');
		$this->form_validation->set_rules('pengetahuan_tnh', 'pengetahuan_tnh', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uts', 'pengetahuan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uas', 'pengetahuan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_tnh', 'keterampilan_tnh', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_projek', 'keterampilan_projek', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_porto', 'keterampilan_porto', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uts', 'keterampilan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uas', 'keterampilan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('sikap_tnh', 'sikap_tnh', 'required|numeric');
		$this->form_validation->set_rules('sikap_pd', 'sikap_pd', 'required|numeric');
		$this->form_validation->set_rules('sikap_ps', 'sikap_ps', 'required|numeric');
		$this->form_validation->set_rules('sikap_jurnal', 'sikap_jurnal', 'required|numeric');
		$this->form_validation->set_rules('sikap_nilai_akhir', 'sikap_nilai_akhir', 'required|numeric');
		// $this->form_validation->set_rules('semester_id', 'semester_id', 'required');

		if($this->form_validation->run() == false){
			$result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();

		}else{
			$formData = [
				'mapel_id'               => $this->input->post('mapel_id'),
				'pengetahuan_tnh'        => $this->input->post('pengetahuan_tnh'),
				'pengetahuan_nilai_uts'  => $this->input->post('pengetahuan_nilai_uts'),
				'pengetahuan_nilai_uas'  => $this->input->post('pengetahuan_nilai_uas'),
				'keterampilan_tnh'       => $this->input->post('keterampilan_tnh'),
				'keterampilan_projek'    => $this->input->post('keterampilan_projek'),
				'keterampilan_porto'     => $this->input->post('keterampilan_porto'),
				'keterampilan_nilai_uts' => $this->input->post('keterampilan_nilai_uts'),
				'keterampilan_nilai_uas' => $this->input->post('keterampilan_nilai_uas'),
				'sikap_tnh'              => $this->input->post('sikap_tnh'),
				'sikap_pd'               => $this->input->post('sikap_pd'),
				'sikap_ps'               => $this->input->post('sikap_ps'),
				'sikap_jurnal'           => $this->input->post('sikap_jurnal'),
				'sikap_nilai_akhir'      => $this->input->post('sikap_nilai_akhir'),
			];

			$insert = $this->db->insert('persentasepenilaian', $formData);

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
        $query = $this->db->query("SELECT * FROM `persentasepenilaian` WHERE persentasepenilaian.id = {$id}");
        if($query->num_rows() > 0){
            $result = $query->row();
        }
        echo json_encode($result);
    }

    public function update(){
        header('Content-Type: application/json');

        $result = [];

        $this->form_validation->set_rules('pengetahuan_tnh', 'pengetahuan_tnh', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uts', 'pengetahuan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('pengetahuan_nilai_uas', 'pengetahuan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_tnh', 'keterampilan_tnh', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_projek', 'keterampilan_projek', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_porto', 'keterampilan_porto', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uts', 'keterampilan_nilai_uts', 'required|numeric');
		$this->form_validation->set_rules('keterampilan_nilai_uas', 'keterampilan_nilai_uas', 'required|numeric');
		$this->form_validation->set_rules('sikap_tnh', 'sikap_tnh', 'required|numeric');
		$this->form_validation->set_rules('sikap_pd', 'sikap_pd', 'required|numeric');
		$this->form_validation->set_rules('sikap_ps', 'sikap_ps', 'required|numeric');
		$this->form_validation->set_rules('sikap_jurnal', 'sikap_jurnal', 'required|numeric');
		$this->form_validation->set_rules('sikap_nilai_akhir', 'sikap_nilai_akhir', 'required|numeric');

        if($this->form_validation->run() == false){
            $result['status'] = 'error';
            $result['error_messages'] = $this->form_validation->error_array();
        }else{
            $id = $this->input->post('id');
            $data = [
				'pengetahuan_tnh'        => $this->input->post('pengetahuan_tnh'),
				'pengetahuan_nilai_uts'  => $this->input->post('pengetahuan_nilai_uts'),
				'pengetahuan_nilai_uas'  => $this->input->post('pengetahuan_nilai_uas'),
				'keterampilan_tnh'       => $this->input->post('keterampilan_tnh'),
				'keterampilan_projek'    => $this->input->post('keterampilan_projek'),
				'keterampilan_porto'     => $this->input->post('keterampilan_porto'),
				'keterampilan_nilai_uts' => $this->input->post('keterampilan_nilai_uts'),
				'keterampilan_nilai_uas' => $this->input->post('keterampilan_nilai_uas'),
				'sikap_tnh'              => $this->input->post('sikap_tnh'),
				'sikap_pd'               => $this->input->post('sikap_pd'),
				'sikap_ps'               => $this->input->post('sikap_ps'),
				'sikap_jurnal'           => $this->input->post('sikap_jurnal'),
				'sikap_nilai_akhir'      => $this->input->post('sikap_nilai_akhir'),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('persentasepenilaian', $data);
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