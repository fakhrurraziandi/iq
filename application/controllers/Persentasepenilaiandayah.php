<?php

require_once 'Backend.php';

defined('BASEPATH') OR exit('No direct script access allowed');

class Persentasepenilaiandayah extends Backend {

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
		$result['rows'][0]->mapeldayah_id = NULL;
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

		

		$mapeldayah_id  = ($this->input->get('mapeldayah_id')) ? $this->input->get('mapeldayah_id') : false;

		if($mapeldayah_id){

			$limit  = ($this->input->get('limit')) ? $this->input->get('limit') : 10;
			$offset = ($this->input->get('offset')) ? $this->input->get('offset') : 0;
			$search = ($this->input->get('search')) ? $this->input->get('search') : '';
			$sort   = ($this->input->get('sort')) ? $this->input->get('sort') : '';
			$order  = ($this->input->get('order')) ? $this->input->get('order') : '';

			$sql = "SELECT
						persentasepenilaiandayah.id,
						persentasepenilaiandayah.mapeldayah_id,
						persentasepenilaiandayah.pengetahuan_tnh,
						persentasepenilaiandayah.pengetahuan_nilai_uts,
						persentasepenilaiandayah.pengetahuan_nilai_uas,
						persentasepenilaiandayah.keterampilan_tnh,
						persentasepenilaiandayah.keterampilan_projek,
						persentasepenilaiandayah.keterampilan_porto,
						persentasepenilaiandayah.keterampilan_nilai_uts,
						persentasepenilaiandayah.keterampilan_nilai_uas,
						persentasepenilaiandayah.sikap_tnh,
						persentasepenilaiandayah.sikap_pd,
						persentasepenilaiandayah.sikap_ps,
						persentasepenilaiandayah.sikap_jurnal,
						persentasepenilaiandayah.sikap_nilai_akhir
					FROM `persentasepenilaiandayah`
					WHERE persentasepenilaiandayah.mapeldayah_id = {$mapeldayah_id} ORDER BY persentasepenilaiandayah.id DESC LIMIT 1 ";

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
				'mapeldayah_id'          => floatval($this->input->post('mapeldayah_id')),
				'pengetahuan_tnh'        => floatval($this->input->post('pengetahuan_tnh')),
				'pengetahuan_nilai_uts'  => floatval($this->input->post('pengetahuan_nilai_uts')),
				'pengetahuan_nilai_uas'  => floatval($this->input->post('pengetahuan_nilai_uas')),
				'keterampilan_tnh'       => floatval($this->input->post('keterampilan_tnh')),
				'keterampilan_projek'    => floatval($this->input->post('keterampilan_projek')),
				'keterampilan_porto'     => floatval($this->input->post('keterampilan_porto')),
				'keterampilan_nilai_uts' => floatval($this->input->post('keterampilan_nilai_uts')),
				'keterampilan_nilai_uas' => floatval($this->input->post('keterampilan_nilai_uas')),
				'sikap_tnh'              => floatval($this->input->post('sikap_tnh')),
				'sikap_pd'               => floatval($this->input->post('sikap_pd')),
				'sikap_ps'               => floatval($this->input->post('sikap_ps')),
				'sikap_jurnal'           => floatval($this->input->post('sikap_jurnal')),
				'sikap_nilai_akhir'      => floatval($this->input->post('sikap_nilai_akhir')),
			];

			$insert = $this->db->insert('persentasepenilaiandayah', $formData);

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
        $query = $this->db->query("SELECT * FROM `persentasepenilaiandayah` WHERE persentasepenilaiandayah.id = {$id}");
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
				'pengetahuan_tnh'        => floatval($this->input->post('pengetahuan_tnh')),
				'pengetahuan_nilai_uts'  => floatval($this->input->post('pengetahuan_nilai_uts')),
				'pengetahuan_nilai_uas'  => floatval($this->input->post('pengetahuan_nilai_uas')),
				'keterampilan_tnh'       => floatval($this->input->post('keterampilan_tnh')),
				'keterampilan_projek'    => floatval($this->input->post('keterampilan_projek')),
				'keterampilan_porto'     => floatval($this->input->post('keterampilan_porto')),
				'keterampilan_nilai_uts' => floatval($this->input->post('keterampilan_nilai_uts')),
				'keterampilan_nilai_uas' => floatval($this->input->post('keterampilan_nilai_uas')),
				'sikap_tnh'              => floatval($this->input->post('sikap_tnh')),
				'sikap_pd'               => floatval($this->input->post('sikap_pd')),
				'sikap_ps'               => floatval($this->input->post('sikap_ps')),
				'sikap_jurnal'           => floatval($this->input->post('sikap_jurnal')),
				'sikap_nilai_akhir'      => floatval($this->input->post('sikap_nilai_akhir')),
            ];
            $this->db->where('id', $id);
            $query = $this->db->update('persentasepenilaiandayah', $data);
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